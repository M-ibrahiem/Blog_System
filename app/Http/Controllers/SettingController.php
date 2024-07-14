<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Setting::all();
        return view('dash.setting.all', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dash.setting.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'logo' => 'required|image',
            // 'favicon' => 'required|image',
            'facebook' => 'required|string',
            'linkedin' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string',
        ];

        foreach ($locales as $localeCode => $properties) {
            $rules["{$localeCode}.title"] = 'required|string';
            $rules["{$localeCode}.content"] = 'required|string';
        }

        // Validate the request
        $validated = $request->validate($rules);


        // Extract all settings excluding images
        $allSettingsWithoutImages = $request->except(['logo', 'favicon']);

           // Save settings to the database
           $setting = Setting::create($allSettingsWithoutImages);
      // Store images using Spatie Media Library

      if ($request->hasFile('logo')) {
        $uploadlogo =  $setting->addMediaFromRequest('logo')->toMediaCollection('logos');
        $setting->update([
            'logo' => $uploadlogo->getUrl()
            ]);

    }

    if ($request->hasFile('favicon')) {
        $uploadfavicon = $setting->addMediaFromRequest('favicon')->toMediaCollection('favicons');
        $setting->update([
            'favicon' => $uploadfavicon->getUrl()
        ]);
    }



        // Redirect to the settings index with success message
        return redirect()->route('dashboard.setting.index')->with('success', 'Settings updated successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        // Implementation if needed
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        return view('dash.setting.edit',compact('setting'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'logo' => 'image',
            // 'favicon' => 'image',
            'facebook' => 'required|string',
            'linkedin' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string',
        ];

        foreach ($locales as $localeCode => $properties) {
            $rules["{$localeCode}.title"] = 'required|string';
            $rules["{$localeCode}.content"] = 'required|string';
        }

        // Validate the request
        $validated = $request->validate($rules);


        // Extract all settings excluding images
        $allSettingsWithoutImages = $request->except(['logo', 'favicon']);

           // Save settings to the database
           $setting->update($allSettingsWithoutImages);
      // Store images using Spatie Media Library

      if ($request->hasFile('logo')) {
        $oldLogo = $setting->media;
        $oldLogo[0]->delete();
        $uploadlogo =  $setting->addMediaFromRequest('logo')->toMediaCollection('logos');
        $setting->update([
            'logo' => $uploadlogo->getUrl()
            ]);

    }

    if ($request->hasFile('favicon')) {
        $oldFav = $setting->media;
        $oldFav[1]->delete();
        $uploadfavicon = $setting->addMediaFromRequest('favicon')->toMediaCollection('favicons');
        $setting->update([
            'favicon' => $uploadfavicon->getUrl()
        ]);
     }

        // Redirect to the settings index with success message
        return redirect()->route('dashboard.setting.index')->with('success', 'Settings updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        $setting->clearMediaCollection('logo');
        $setting->clearMediaCollection('favicon');
        $setting->delete();
        return redirect()->route('dashboard.setting.index')->with('success', 'Settings updated successfully.');
    }


}
