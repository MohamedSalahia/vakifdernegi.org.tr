<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnnualReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/** Admin: yearly activity / financial reports (PDF), listed on the public reports page. */
class AnnualReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_settings');
    }

    public function index()
    {
        $reports = AnnualReport::orderByDesc('year')->orderByDesc('id')->get();

        return view('admin.annual_reports.index', compact('reports'));
    }

    public function create()
    {
        return view('admin.annual_reports.form', ['report' => new AnnualReport(['year' => (int) date('Y') - 1, 'is_published' => true])]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request, true);
        $data['file'] = basename($request->file('file')->store('annual_reports', 'public'));
        AnnualReport::create($data);
        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('admin.annual_reports.index');
    }

    public function edit(AnnualReport $annualReport)
    {
        return view('admin.annual_reports.form', ['report' => $annualReport]);
    }

    public function update(Request $request, AnnualReport $annualReport)
    {
        $data = $this->validated($request, false);
        if ($request->hasFile('file')) {
            Storage::disk('public')->delete('annual_reports/' . $annualReport->file);
            $data['file'] = basename($request->file('file')->store('annual_reports', 'public'));
        }
        $annualReport->update($data);
        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('admin.annual_reports.index');
    }

    public function destroy(AnnualReport $annualReport)
    {
        Storage::disk('public')->delete('annual_reports/' . $annualReport->file);
        $annualReport->delete();
        session()->flash('success', __('site.deleted_successfully'));

        return redirect()->route('admin.annual_reports.index');
    }

    private function validated(Request $request, bool $fileRequired): array
    {
        $data = $request->validate([
            'year' => 'required|integer|min:2000|max:2100',
            'title_tr' => 'required|string|max:255',
            'title_ar' => 'nullable|string|max:255',
            'file' => ($fileRequired ? 'required' : 'nullable') . '|file|mimes:pdf|max:20480',
        ], [], ['year' => __('site.report_year'), 'title_tr' => __('site.update_title') . ' (TR)', 'file' => 'PDF']);
        $data['is_published'] = $request->boolean('is_published');
        unset($data['file']);

        return $data;
    }
}
