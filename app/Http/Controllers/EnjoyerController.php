<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Enjoyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class EnjoyerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $sort_search = null;
        $enjoyers = Enjoyer::orderBy('created_at', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $user_ids = User::where('user_type', 'user')->where(function($user) use ($sort_search){
                $user->where('name', 'like', '%'.$sort_search.'%')->orWhere('email', 'like', '%'.$sort_search.'%');
            })->pluck('id')->toArray();
            $enjoyers = $enjoyers->where(function($enjoyer) use ($user_ids){
                $enjoyer->whereIn('user_id', $user_ids);
            });
        }
        $enjoyers = $enjoyers->paginate(15);

        return view('users.index', compact('enjoyers', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        User::destroy(Enjoyer::findOrFail($id)->user->id);
        if(Enjoyer::destroy($id)){
            flash()->AddSuccess(__('User has been deleted successfully'));
            return redirect()->route('users.index');
        }

        flash()->AddError(__('Something went wrong'));
        return back();
    }
}
