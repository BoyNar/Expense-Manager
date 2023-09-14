<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;

class LanguageController extends Controller
{
    public function changeLanguage(Request $request)
    {
    	$request->session()->put('locale', $request->locale);
        $language = Language::where('code', $request->locale)->first();
    	flash()->AddSuccess(__('Language changed to ').$language->name);
    }

    public function index(Request $request)
    {
        $languages = Language::all();
        return view('business_settings.languages.index', compact('languages'));
    }

    public function create(Request $request)
    {
        return view('business_settings.languages.create');
    }

    public function store(Request $request)
    {
        $language = new Language;
        $language->name = $request->name;
        $language->code = $request->code;
        if($language->save()){
            saveJSONFile($language->code, openJSONFile('en'));
            flash()->AddSuccess(__('Language has been inserted successfully'));
            return redirect()->route('languages.index');
        }
        else{
            flash()->addError(__('Something went wrong'));
            return back();
        }
    }

    public function show($id)
    {
        $language = Language::findOrFail(decrypt($id));
        return view('business_settings.languages.language_view', compact('language'));
    }

    public function edit($id)
    {
        $language = Language::findOrFail(decrypt($id));
        return view('business_settings.languages.edit', compact('language'));
    }

    public function update(Request $request, $id)
    {
        $language = Language::findOrFail($id);
        $language->name = $request->name;
        $language->code = $request->code;
        if($language->save()){
            flash()->AddSuccess(__('Language has been updated successfully'));
            return redirect()->route('languages.index');
        }
        else{
            flash()->AddError(__('Something went wrong'));
            return back();
        }
    }

    public function key_value_store(Request $request)
    {
        $language = Language::findOrFail($request->id);
        $data = openJSONFile($language->code);
        foreach ($request->key as $key => $key) {
            $data[$key] = $request->key[$key];
        }
        saveJSONFile($language->code, $data);
        flash()->AddSuccess(__('Key-Value updated  for ').$language->name);
        return back();
    }

    public function destroy($id)
    {
        if(Language::destroy($id)){
            flash()->AddSuccess(__('Language has been deleted successfully'));
            return redirect()->route('languages.index');
        }
        else{
            flash()->AddError(__('Something went wrong'));
            return back();
        }
    }
}
