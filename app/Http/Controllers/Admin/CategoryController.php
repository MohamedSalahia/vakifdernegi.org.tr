<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_categories')->only(['index']);
        $this->middleware('permission:create_categories')->only(['create', 'store']);
        $this->middleware('permission:update_categories')->only(['edit', 'update']);
        $this->middleware('permission:delete_categories')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.categories.index');

    }// end of index

    public function data()
    {
        $categories = Category::with(['parent'])->orderBy('id', 'desc')->get();

        return DataTables::of($categories)
            ->addColumn('record_select', 'admin.categories.data_table.record_select')
            ->addColumn('actions', 'admin.categories.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data


    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.create', compact('categories'));

    }// end of create

    public function store(Request $request)
    {

        $rules = [];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required', Rule::unique('category_translations', 'name')]];

        }//end of for each

        $request->validate($rules);
        //$request->validated();

        Category::create($request->all());

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.categories.index');

    }// end of store

    public function edit(Category $category)
    {
        //dd($category->name);
        $categories = Category::where('id', '!=', $category->id)->get();
        return view('admin.categories.edit', compact('category', 'categories'));

    }// end of edit

    public function update(Request $request, Category $category)
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required', Rule::unique('category_translations', 'name')->ignore($category->id, 'category_id')]];

        }//end of for each

        $request->validate($rules);

        $category->update($request->all());

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.categories.index');

    }// end of update

    public function destroy(Category $category)
    {

        $this->delete($category);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $category = Category::FindOrFail($recordId);

            $this->delete($category);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Category $category)
    {
        $category->delete();

    }// end of delete

    public function show(Category $category)
    {
        $categories = Category::all();
        $blogs = Blog::where('category_id', '=', $category->id)->paginate(2);
        return view('web.category', compact(['category', 'blogs', 'categories'] ));

    }// end of delete
}
