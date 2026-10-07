<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebsiteSettingController extends Controller
{
    public function index()
    {
        $settings = WebsiteSetting::pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'logo' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
            'favicon' => ['nullable', 'file', 'mimes:ico,png,jpg,jpeg,webp', 'max:1024'],
        ], [
            'logo.image' => 'The logo must be an image.',
            'logo.mimes' => 'The logo must be a PNG, JPG or WEBP file.',
            'logo.max' => 'The logo must not be larger than 2 MB.',
            'favicon.mimes' => 'The favicon must be an ICO, PNG, JPG or WEBP file.',
            'favicon.max' => 'The favicon must not be larger than 1 MB.',
        ]);

        $data = $request->except(['_token', 'logo', 'favicon']);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('settings', 'public');
            WebsiteSetting::updateOrCreate(
                ['key' => 'logo'],
                ['value' => $path]
            );
        }

        if ($request->hasFile('favicon')) {
            $this->deleteFavicon();
            $path = $request->file('favicon')->store('settings', 'public');
            WebsiteSetting::updateOrCreate(
                ['key' => 'favicon'],
                ['value' => $path]
            );
        }

        foreach ($data as $key => $value) {
            WebsiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
        return redirect()->back()->with('success', 'Settings updated successfully.');
    }

    private function deleteFavicon(): void
    {
        $current = WebsiteSetting::where('key', 'favicon')->value('value');

        if ($current && Storage::disk('public')->exists($current)) {
            Storage::disk('public')->delete($current);
        }
    }
}
