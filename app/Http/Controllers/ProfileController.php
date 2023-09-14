<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('partials.profile');
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
        $user = User::findOrFail($id);
        $user->name = $request->name;
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
