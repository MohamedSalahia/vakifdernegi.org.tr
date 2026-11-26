<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\DonationSettings;
use Illuminate\Http\Request;

/** Admin: "Bağış Ayarları" — preset amounts, limits and optional donation features. */
class DonationSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_settings');
    }

    public function edit()
    {
        $settings = DonationSettings::all();

        return view('admin.settings.donations', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'presets' => 'required|string|max:200',
            'min_amount' => 'required|integer|min:1|max:100000',
            'max_amount' => 'required|integer|gte:min_amount|max:100000000',
        ], [], [
            'presets' => __('site.ds_presets'), 'min_amount' => __('site.ds_min_amount'), 'max_amount' => __('site.ds_max_amount'),
        ]);

        $presets = collect(preg_split('/[\s,;]+/', $data['presets']))
            ->map(fn ($v) => (int) preg_replace('/\D/', '', $v))
            ->filter(fn ($v) => $v >= (int) $data['min_amount'] && $v <= (int) $data['max_amount'])
            ->unique()->sort()->values()->take(8)->all();

        if (count($presets) === 0) {
            return back()->withInput()->withErrors(['presets' => __('site.ds_presets_invalid')]);
        }

        setting(['donation' => [
            'presets' => $presets,
            'min_amount' => (int) $data['min_amount'],
            'max_amount' => (int) $data['max_amount'],
            'quick_donate_enabled' => $request->boolean('quick_donate_enabled'),
            'dedication_enabled' => $request->boolean('dedication_enabled'),
            'zakat_option_enabled' => $request->boolean('zakat_option_enabled'),
            'show_name_option_enabled' => $request->boolean('show_name_option_enabled'),
        ]])->save();

        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('admin.settings.donations');
    }
}
