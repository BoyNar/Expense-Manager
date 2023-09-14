<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $categories = Category::orderBy('created_at', 'desc');//->where('user_id', Auth::user()->id);
        if ($request->has('search')){
            $sort_search = $request->search;
            $categories = $categories->where('name', 'like', '%'.$sort_search.'%');
        }
        $categories = $categories->paginate(15);
        return view('categories.index', compact('categories', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            return redirect()->route('categories.index');
        }
        else{
            flash()->addError(__('Something went wrong'));
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category = Category::findOrFail(decrypt($id));
        abort_if($category->user_id  =! Auth::user()->id, 404);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $category = Category::findOrFail($id);
        $category->user_id = Auth::user()->id;
        $category->name = $request->name;
        $category->description = $request->description;
        if($category->save()){
            flash()->addSuccess(__('Category has been updated successfully'));
            return redirect()->route('categories.index');
        }
        else{
            flash()->addError(__('Something went wrong'))->error();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $category = Category::findOrFail($id);
        Expense::where('category_id', $category->id)->delete();
        if(Category::destroy($id)){
            flash()->addSuccess(__('Category has been deleted successfully'));
            return redirect()->route('categories.index');
        }
        else{
            flash()->addError(__('Something went wrong'));
            return back();
        }
    }
}
