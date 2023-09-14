<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    //

    public function login()
    {
        if(Auth::check()){
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    public function registration(Request $request)
    {
        if(Auth::check()){
            return redirect()->route('home');
        }
        return view('auth.register');
    }

    public $categories;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->categories = Category::getAllCategories();
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_dashboard()
    {
        return view('dashboard');
    }

    /**
     * Show the customer/seller dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        if(Auth::user()->user_type == 'user'){
            return view('user.dashboard');
        }
        else {
            abort(404);
        }
    }

    public function profile(Request $request)
    {
        if(Auth::user()->user_type == 'user'){
            return view('user.partials.profile');
        }
    }

    public function user_update_profile(Request $request)
    {
        $user = Auth::user();
        $user->email = $request->email;
        if($request->new_password != null && ($request->new_password == $request->confirm_password)){
            $user->password = Hash::make($request->new_password);
        }
        if (request()->hasFile('avatar') && request()->file('avatar')->isValid()){
            if (Storage::exists('avatars/'.$user->id)) {
                Storage::deleteDirectory('avatars/'.$user->id);
            }
            $extensions = request()->file('avatar')->extension();
            $filename = Str::slug($user->name).'-'.$user->id.'.'.$extensions;
            $path = request()->file('avatar')->storeAs('avatars/'.$user->id, $filename);
            $thumbnailImage = Image::make(request()->file('avatar'))->fit(250, 250, function($constraint){
                $constraint->upsize();
            })->encode($extensions, 100);
            $thumbnailPath = 'avatars/'.$user->id.'/thumbnail/'.$filename;
            Storage::put($thumbnailPath, $thumbnailImage);
            $user->avatar()->updateOrCreate(['user_id'=>$user->id],
            [
                'filename'=>$filename,
                'url'=>Storage::url($path),
                'path'=>$path,
                'thumb_url'=>Storage::url($thumbnailPath),
                'thumb_path'=>$thumbnailPath,
            ]);
        }


        if($user->save()){
            flash()->addSuccess(__('Your Profile has been updated successfully!'));
            return back();
        }

        flash()->addError(__('Sorry! Something went wrong.'));
        return back();
        if($user->save()){
            flash(__('Your Profile has been updated successfully!'));
            return back();
        }

        flash(__('Sorry! Something went wrong.'))->error();
        return back();
    }

    public function user_categories_list(Request $request)
    {
        $sort_search =null;
        $categories = Category::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id);
        if ($request->has('search')){
            $sort_search = $request->search;
            $categories = $categories->where('name', 'like', '%'.$sort_search.'%');
        }
        $categories = $categories->paginate(15);
        return view('user.categories.index', compact('categories', 'sort_search'));
    }

    public function user_category_create()
    {
        //
        return view('user.categories.create');
    }

    public function user_category_store(Request $request)
    {
        //
        $categorie = new Category;
        $categorie->user_id = Auth::user()->id;
        $categorie->name = $request->name;
        $categorie->description = $request->description;

        if(Category::query()
        ->where('name', $request->name)
        ->where('user_id', auth()->id())
        ->exists()
        ){
        flash()->addWarning('You already have a category with this name.');
         return back();
        }
        if($categorie->save()){
            flash()->addSuccess(__('Category has been inserted successfully'));
            return redirect()->route('user.categories');
        }
        else{
            flash()->addError(__('Something went wrong'));
            return back();
        }
    }

    public function user_category_edit($id)
    {
        //
        $category = Category::findOrFail(decrypt($id));
        abort_if($category->user_id  =! Auth::user()->id, 404);
        return view('user.categories.edit', compact('category'));
    }

    public function user_category_update(Request $request, $id)
    {
        //
        $category = Category::findOrFail($id);
        $category->user_id = Auth::user()->id;
        $category->name = $request->name;
        $category->description = $request->description;
        if($category->save()){
            flash()->addSuccess(__('Category has been updated successfully'));
            return redirect()->route('user.categories');
        }
        else{
            flash()->addError(__('Something went wrong'))->error();
            return back();
        }
    }

    public function user_category_destroy($id)
    {
        //

        $category = Category::findOrFail($id);
        Expense::where('category_id', $category->id)->delete();
        if(Category::destroy($id)){
            flash()->addSuccess(__('Category has been deleted successfully'));
            return redirect()->route('user.categories');
        }
        else{
            flash()->addError(__('Something went wrong'));
            return back();
        }
    }

    public function user_expense_list(Request $request)
    {
        $sort_search =null;
        $expenses = Expense::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id);
        if ($request->has('search')){
            $sort_search = $request->search;
            $expenses = $expenses->where('name', 'like', '%'.$sort_search.'%');
        }
        $expenses = $expenses->paginate(15);
        return view('user.expenses.index', compact('expenses', 'sort_search'));
    }

    public function user_expense_create()
    {
        //
        $categories = $this->categories->where('user_id', Auth::user()->id);
        return view('user.expenses.create', compact('categories'));
    }

    public function user_expense_store(Request $request)
    {
        //
        $expense = New Expense();
        $expense->name = $request->name;
        $expense->date = strtotime($request->date);
        $expense->amount = $request->amount;
        $expense->user_id = Auth::user()->id;
        $expense->category_id = $request->category_id;
        $expense->description = $request->description;
        if($expense->save()){
            flash()->addSuccess(__('Expense has been created successfull.'));
            return redirect()->route('user.expenses');
        }
        else{
            flash()->addError(__('Something went wrong'));
            return back();
        }

    }

    public function user_expense_edit(string $id)
    {
        //
        $expense = Expense::findOrFail(decrypt($id));
        $categories = $this->categories->where('user_id', Auth::user()->id);
        return view('user.expenses.edit', compact('categories', 'expense'));
    }

    public function user_expense_update(Request $request, string $id)
    {
        //
        $expense = Expense::findOrFail($id);
        $expense->name = $request->name;
        $expense->date = strtotime($request->date);
        $expense->amount = $request->amount;
        $expense->user_id = Auth::user()->id;
        $expense->category_id = $request->category_id;
        $expense->description = $request->description;
        if($expense->save()){
            flash()->addSuccess(__('Expense has been updated successfull.'));
            return redirect()->route('user.expenses');
        }
        else{
            flash()->addError(__('Something went wrong'));
            return back();
        }

    }

    public function user_expense_destroy(string $id)
    {
        //
        $expense = Expense::findOrFail($id);
        if(Expense::destroy($id)){
            flash()->addSuccess(__('Expense has been deleted successfully'));
            return redirect()->route('user.expenses');
        }
        else{
            flash()->addError(__('Something went wrong'));
            return back();
        }

    }

}
