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
        return view('setting.all', compact('data'));
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
            'logo' => 'required|image',
            'favicon' => 'required|image',
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
            'logo' => $uploadfavicon->getUrl()
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
        // Implementation if needed
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        // Implementation if needed
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        // Implementation if needed
    }
}
