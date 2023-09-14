<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
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
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $expenses = Expense::orderBy('created_at', 'desc');//->where('user_id', Auth::user()->id);
        if ($request->has('search')){
            $sort_search = $request->search;
            $expenses = $expenses->where('name', 'like', '%'.$sort_search.'%');
        }
        $expenses = $expenses->paginate(15);
        return view('expenses.index', compact('expenses', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = $this->categories->where('user_id', Auth::user()->id);
        return view('expenses.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
            return redirect()->route('expenses.index');
        }
        else{
            flash()->addError(__('Something went wrong'));
            return back();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $expense = Expense::findOrFail(decrypt($id));
        $tags = json_decode($expense->tags);
        $categories = $this->categories->where('user_id', Auth::user()->id);
        return view('expenses.edit', compact('categories', 'expense', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
            return redirect()->route('expenses.index');
        }
        else{
            flash()->addError(__('Something went wrong'));
            return back();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $expense = Expense::findOrFail($id);
        if(Expense::destroy($id)){
            flash()->addSuccess(__('Expense has been deleted successfully'));
            return redirect()->route('expenses.index');
        }
        else{
            flash()->addError(__('Something went wrong'));
            return back();
        }

    }
}
