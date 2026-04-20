<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:settings.manage');
    }

    public function edit(): View
    {
        $general = Setting::firstOrCreate(['key' => 'general'], ['value' => [
            'site_name' => 'Logistax News',
            'site_logo' => null,
            'footer_text' => '© Logistax',
        ]]);

        return view('admin.settings.general', compact('general'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'site_logo' => ['nullable', 'string', 'max:255'],
            'footer_text' => ['required', 'string', 'max:255'],
        ]);

        Setting::updateOrCreate(['key' => 'general'], ['value' => $data]);

        return back()->with('success', 'Settings updated.');
    }
}
