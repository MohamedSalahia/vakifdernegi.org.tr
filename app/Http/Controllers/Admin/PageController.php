<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Category;
use App\Models\PageCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_pages')->only(['index']);
        $this->middleware('permission:create_pages')->only(['create', 'store']);
        $this->middleware('permission:update_pages')->only(['edit', 'update']);
        $this->middleware('permission:delete_pages')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.pages.index');

    }// end of index

    public function data()
    {
        $pages = Page::orderBy('created_at', 'desc')->get();

        return DataTables::of($pages)
            ->addColumn('record_select', 'admin.pages.data_table.record_select')
            ->addColumn('actions', 'admin.pages.data_table.actions')
            ->addColumn('images', 'admin.pages.data_table.images')
            ->rawColumns(['record_select', 'actions', 'images'])
            ->toJson();




    }// end of data

    public function create()
    {
        //$categories = PageCategory::all();
        return view('admin.pages.create');

    }// end of create

    public function store(Request $request)
    {

        //dd($request);


        //dd($request->header_show);
        $rules = [
            /*'page_category_id' => 'required',*/
        ];
        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required']];
            $rules += [$locale . '.description' => ['required']];

        }//end of for each

        $request->validate($rules);
        $request_data = $request->except(['image']);

        if ($request->image) {

            $file = $request->file('image');

            $path = $file->hashName('public/page_images');

            $image = Image::make($file);

            /*$image->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });*/

            Storage::put($path, (string) $image->encode());

            $request_data['image'] = $request->image->hashName();

        }//end of if

        //dd($request_data);

        Page::create($request_data);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.pages.index');

    }// end of store

    public function edit(Page $page)
    {
        //$categories = PageCategory::all();
        return view('admin.pages.edit', compact('page'));

    }// end of edit

    public function update(Request $request, Page $page)
    {
        /*if ($request->special == null){
            $request->request->add(['special' => null]); //add request
        }

        if ($request->header_show == null){
            $request->request->add(['header_show' => null]); //add request
        }*/

        //dd($request);
        $rules = [
            /*'page_category_id' => 'required'*/
        ];


        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required'/*, Rule::unique('page_translations', 'name')->ignore($page->id, 'page_id')*/]];
            $rules += [$locale . '.description' => 'required'];

        }//end of  for each

        //dd($rules);

        $request->validate($rules);

        $request_data = $request->all();

        if ($request->image) {

            if ($page->image != null) {

                Storage::delete('public/page_images/' . $page->image);

            }//end of if
            $file = $request->file('image');

            $path = $file->hashName('public/page_images');

            $image = Image::make($file);

            Storage::put($path, (string) $image->encode());

            $request_data['image'] = $request->image->hashName();

        }//end of if
        //dd($request_data);
        $page->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.pages.index');

    }// end of update

    public function destroy(Page $page)
    {
        if ($page->image != null) {

            Storage::delete('public/page_images/' . $page->image);

        }//end of if
        $this->delete($page);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $page = Page::FindOrFail($recordId);

            if ($page->image != null) {

                Storage::delete('public/page_images/' . $page->image);

            }//end of if

            $this->delete($page);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Page $page)
    {
        $page->delete();

    }// end of delete

    public function show(Page $page)
    {
        return view('web.page', compact('page'));

    }// end of delete
}
