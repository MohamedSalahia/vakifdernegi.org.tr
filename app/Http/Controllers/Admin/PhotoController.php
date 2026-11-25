<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;

class PhotoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_photos')->only(['index']);
        $this->middleware('permission:create_photos')->only(['create', 'store']);
        $this->middleware('permission:update_photos')->only(['edit', 'update']);
        $this->middleware('permission:delete_photos')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.photos.index');

    }// end of index

    public function data()
    {
        $photos = Photo::orderBy('id', 'desc')->get();
        //dd($photos);

        return DataTables::of($photos)
            ->addColumn('record_select', 'admin.photos.data_table.record_select')
            ->addColumn('actions', 'admin.photos.data_table.actions')
            ->addColumn('images', 'admin.photos.data_table.images')
            ->rawColumns(['record_select', 'actions', 'images'])
            ->toJson();

    }// end of data

    public function create()
    {
        $categories = Category::all();
        return view('admin.photos.create', compact('categories'));

    }// end of create

    public function store(Request $request)
    {

        $request_data = $request->except(['image']);

        if ($request->image) {

            $file = $request->file('image');

            $path = $file->hashName('public/photo_images');

            $image = Image::make($file);

            /*$image->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });*/

            Storage::put($path, (string) $image->encode());

            $request_data['image'] = $request->image->hashName();

        }//end of if

        //dd($request_data);

        Photo::create($request_data);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.photos.index');

    }// end of store

    public function edit(Photo $photo)
    {
        $categories = Category::all();
        return view('admin.photos.edit', compact('photo', 'categories'));

    }// end of edit

    public function update(Request $request, Photo $photo)
    {

        //dd($photo->id);


        $request_data = $request->all();

        if ($request->image) {

            if ($photo->image != null) {

                Storage::delete('public/photo_images/' . $photo->image);

            }//end of if
            $file = $request->file('image');

            $path = $file->hashName('public/photo_images');

            $image = Image::make($file);

            Storage::put($path, (string) $image->encode());

            $request_data['image'] = $request->image->hashName();

        }//end of if

        $photo->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.photos.index');

    }// end of update

    public function destroy(Photo $photo)
    {
        if ($photo->image != null) {

            Storage::delete('public/photo_images/' . $photo->image);

        }//end of if
        $this->delete($photo);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $photo = Photo::FindOrFail($recordId);

            if ($photo->image != null) {

                Storage::delete('public/photo_images/' . $photo->image);

            }//end of if

            $this->delete($photo);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Photo $photo)
    {
        $photo->delete();

    }// end of delete

    public function show(Photo $photo)
    {
        $categories = Category::all();
        return view('web.photo', compact(['photo', 'categories']));

    }// end of delete
}
