<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VideoRequest;
use App\Models\Video;
use App\Models\VideoTranslation;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_videos')->only(['index']);
        $this->middleware('permission:create_videos')->only(['create', 'store']);
        $this->middleware('permission:update_videos')->only(['edit', 'update']);
        $this->middleware('permission:delete_videos')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.videos.index');

    }// end of index

    public function data()
    {
        $videos = Video::orderBy('id', 'desc')->get();

        return DataTables::of($videos)
            ->addColumn('record_select', 'admin.videos.data_table.record_select')
            ->addColumn('actions', 'admin.videos.data_table.actions')
            ->addColumn('images', 'admin.videos.data_table.images')
            ->rawColumns(['record_select', 'actions', 'images'])
            ->toJson();

    }// end of data

    public function create()
    {
        $categories = Category::all();
        return view('admin.videos.create', compact('categories'));

    }// end of create

    public function store(Request $request)
    {
        $rules = [
            'category_id' => 'required',
        ];
        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required', Rule::unique('video_translations', 'name')]];
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

            $path = $file->hashName('public/video_images');

            $image = Image::make($file);

            /*$image->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });*/

            Storage::put($path, (string) $image->encode());

            $request_data['image'] = $request->image->hashName();

        }//end of if

        //dd($request_data);

        Video::create($request_data);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.videos.index');

    }// end of store

    public function edit(Video $video)
    {
        $categories = Category::all();
        return view('admin.videos.edit', compact('video', 'categories'));

    }// end of edit

    public function update(Request $request, Video $video)
    {
        $rules = [
            'category_id' => 'required'
        ];
        //dd($video->id);
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

            if ($video->image != null) {

                Storage::delete('public/video_images/' . $video->image);

            }//end of if
            $file = $request->file('image');

            $path = $file->hashName('public/video_images');

            $image = Image::make($file);

            Storage::put($path, (string) $image->encode());

            $request_data['image'] = $request->image->hashName();

        }//end of if

        $video->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.videos.index');

    }// end of update

    public function destroy(Video $video)
    {
        if ($video->image != null) {

            Storage::delete('public/video_images/' . $video->image);

        }//end of if
        $this->delete($video);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $video = Video::FindOrFail($recordId);

            if ($video->image != null) {

                Storage::delete('public/video_images/' . $video->image);

            }//end of if

            $this->delete($video);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Video $video)
    {
        $video->delete();

    }// end of delete

    public function show(Video $video)
    {
        $categories = Category::all();
        return view('web.video', compact(['video', 'categories']));

    }// end of delete
}
