<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CampaignCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class CampaignCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_campaign_categories')->only(['index']);
        $this->middleware('permission:create_campaign_categories')->only(['create', 'store']);
        $this->middleware('permission:update_campaign_categories')->only(['edit', 'update']);
        $this->middleware('permission:delete_campaign_categories')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.campaign_categories.index');

    }// end of index

    public function data()
    {
        $campaign_categories = CampaignCategory::orderBy('created_at', 'desc')->get();

        return DataTables::of($campaign_categories)
            ->addColumn('record_select', 'admin.campaign_categories.data_table.record_select')
            ->addColumn('actions', 'admin.campaign_categories.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data

    public function create()
    {
        $campaign_categories = CampaignCategory::all();
        return view('admin.campaign_categories.create', compact('campaign_categories'));

    }// end of create

    public function store(Request $request)
    {

        $rules = [];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required', Rule::unique('campaign_category_translations', 'name')]];

        }//end of for each

        $request->validate($rules);

        CampaignCategory::create($request->all());

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.campaign_categories.index');

    }// end of store

    public function edit(CampaignCategory $campaignCategory)
    {
        $campaign_categories = CampaignCategory::where('id', '!=', $campaignCategory->id)->get();
        return view('admin.campaign_categories.edit', compact('campaignCategory', 'campaign_categories'));

    }// end of edit

    public function update(Request $request, CampaignCategory $campaignCategory)
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required']];

        }//end of for each

        $request->validate($rules);

        $campaignCategory->update($request->all());

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.campaign_categories.index');

    }// end of update

    public function destroy(CampaignCategory $campaignCategory)
    {

        $this->delete($campaignCategory);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $category = CampaignCategory::FindOrFail($recordId);

            $this->delete($category);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(CampaignCategory $category)
    {
        $category->delete();

    }// end of delete
}
