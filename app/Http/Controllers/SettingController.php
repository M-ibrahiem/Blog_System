<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Setting::all();
        return view('setting.all',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('setting.add');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $locales = LaravelLocalization::getSupportedLocales();
        $rules = [
            'logo' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'required|image|file|max:2048',
            'facebook' => 'required',
            'linkedin' => 'required',
            'phone' => 'required|regex:/^[0-9]{10,15}$/',
            'email' => 'required|email',
            'title.*' => 'required|string|max:255',
            'content.*' => 'required|string',

        ];
        // Save other settings
        foreach ($locales as $localeCode => $properties) {
            $rules["{$localeCode}.title"] = 'required|string';
            $rules["{$localeCode}.content"] = 'required|string';
        }

        $request->validate($rules);

        $allSettingsWithoutImages = $request->except(['logo','favicon']);
        // setting::create($allSettingsWithoutImages);
        Setting::create($request->all());

            //  // Handle file uploads
            //  if ($request->hasFile('logo')) {
            //     $validatedData['logo'] = $request->file('logo')->store('logos', 'public');
            // }

            // if ($request->hasFile('favicon')) {
            //     $validatedData['favicon'] = $request->file('favicon')->store('favicons', 'public');
            // }


        // return redirect()->route('dashboard.setting.index')->with('success', 'Settings updated successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
