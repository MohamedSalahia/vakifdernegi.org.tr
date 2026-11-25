<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogRequest;
use App\Models\Blog;
use App\Models\BlogTranslation;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_blogs')->only(['index']);
        $this->middleware('permission:create_blogs')->only(['create', 'store']);
        $this->middleware('permission:update_blogs')->only(['edit', 'update']);
        $this->middleware('permission:delete_blogs')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.blogs.index');

    }// end of index

    public function data()
    {
        $blogs = Blog::orderBy('id', 'desc')->get();

        return DataTables::of($blogs)
            ->addColumn('record_select', 'admin.blogs.data_table.record_select')
            ->addColumn('actions', 'admin.blogs.data_table.actions')
            ->addColumn('images', 'admin.blogs.data_table.images')
            ->rawColumns(['record_select', 'actions', 'images'])
            ->toJson();

    }// end of data

    public function create()
    {
        $categories = Category::all();
        return view('admin.blogs.create', compact('categories'));

    }// end of create

    public function store(Request $request)
    {
        $rules = [
            'category_id' => 'required',
        ];
        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required', Rule::unique('blog_translations', 'name')]];
            $rules += [$locale . '.description' => ['required']];
            $rules += [$locale . '.meta_title' => ['required']];
            $rules += [$locale . '.meta_description' => ['required']];
            $rules += [$locale . '.keywords' => ['required']];
            $rules += [$locale . '.image_alt' => ['required']];


        }//end of for each

        $request->validate($rules);
        $request_data = $request->except(['image']);

        if ($request->image) {

            $file = $request->file('image');
            dd($file);

            $path = $file->hashName('public/blog_images');

            $image = Image::make($file);

            /*$image->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });*/

            Storage::put($path, (string) $image->encode());

            $request_data['image'] = $request->image->hashName();

        }//end of if

        //dd($request_data);

        Blog::create($request_data);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.blogs.index');

    }// end of store

    public function edit(Blog $blog)
    {
        $categories = Category::all();
        return view('admin.blogs.edit', compact('blog', 'categories'));

    }// end of edit

    public function update(Request $request, Blog $blog)
    {
        $rules = [
            'category_id' => 'required'
        ];
        //dd($blog->id);
        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required']];
            $rules += [$locale . '.description' => 'required'];
            $rules += [$locale . '.meta_title' => ['required']];
            $rules += [$locale . '.meta_description' => ['required']];
            $rules += [$locale . '.keywords' => ['required']];
            $rules += [$locale . '.image_alt' => ['required']];

        }//end of  for each

        $request->validate($rules);

        $request_data = $request->all();

        if ($request->image) {

            if ($blog->image != null) {

                Storage::delete('public/blog_images/' . $blog->image);

            }//end of if
            $file = $request->file('image');

            $path = $file->hashName('public/blog_images');

            $image = Image::make($file);

            Storage::put($path, (string) $image->encode());

            $request_data['image'] = $request->image->hashName();

        }//end of if

        $blog->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.blogs.index');

    }// end of update

    public function destroy(Blog $blog)
    {
        if ($blog->image != null) {

            Storage::delete('public/blog_images/' . $blog->image);

        }//end of if
        $this->delete($blog);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $blog = Blog::FindOrFail($recordId);

            if ($blog->image != null) {

                Storage::delete('public/blog_images/' . $blog->image);

            }//end of if

            $this->delete($blog);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Blog $blog)
    {
        $blog->delete();

    }// end of delete

    public function show(Blog $blog)
    {
        $categories = Category::all();
        return view('web.blog', compact(['blog', 'categories']));

    }// end of delete
}
