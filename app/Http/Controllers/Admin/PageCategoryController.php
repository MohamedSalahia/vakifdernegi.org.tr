<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class PageCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_page_categories')->only(['index']);
        $this->middleware('permission:create_page_categories')->only(['create', 'store']);
        $this->middleware('permission:update_page_categories')->only(['edit', 'update']);
        $this->middleware('permission:delete_page_categories')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.page_categories.index');

    }// end of index

    public function data()
    {
        $page_categories = PageCategory::orderBy('created_at', 'desc')->get();

        return DataTables::of($page_categories)
            ->addColumn('record_select', 'admin.page_categories.data_table.record_select')
            ->addColumn('actions', 'admin.page_categories.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data

    public function create()
    {
        $page_categories = PageCategory::all();
        return view('admin.page_categories.create', compact('page_categories'));

    }// end of create

    public function store(Request $request)
    {

        $rules = [];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required', Rule::unique('category_translations', 'name')]];

        }//end of for each

        $request->validate($rules);
        //$request->validated();

        PageCategory::create($request->all());

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.page_categories.index');

    }// end of store

    public function edit(PageCategory $pageCategory)
    {
        $page_categories = PageCategory::where('id', '!=', $pageCategory->id)->get();
        return view('admin.page_categories.edit', compact('pageCategory', 'page_categories'));

    }// end of edit

    public function update(Request $request, PageCategory $pageCategory)
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required', Rule::unique('page_category_translations', 'name')->ignore($pageCategory->id, 'page_category_id')]];

        }//end of for each

        $request->validate($rules);

        $pageCategory->update($request->all());

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.page_categories.index');

    }// end of update

    public function destroy(PageCategory $category)
    {

        $this->delete($category);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $category = PageCategory::FindOrFail($recordId);

            $this->delete($category);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(PageCategory $category)
    {
        $category->delete();

    }// end of delete
}
