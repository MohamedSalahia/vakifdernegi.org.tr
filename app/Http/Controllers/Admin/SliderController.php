<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\SliderTranslation;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_sliders')->only(['index']);
        $this->middleware('permission:create_sliders')->only(['create', 'store']);
        $this->middleware('permission:update_sliders')->only(['edit', 'update']);
        $this->middleware('permission:delete_sliders')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.sliders.index');

    }// end of index

    public function data()
    {
        $sliders = Slider::orderBy('id', 'desc')->get();

        return DataTables::of($sliders)
            ->addColumn('record_select', 'admin.sliders.data_table.record_select')
            ->addColumn('actions', 'admin.sliders.data_table.actions')
            ->addColumn('images', 'admin.sliders.data_table.images')
            ->rawColumns(['record_select', 'actions', 'images'])
            ->toJson();

    }// end of data

    public function create()
    {
        return view('admin.sliders.create');
    }// end of create

    public function store(Request $request)
    {
        $rules = [];
        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.subhead' => ['required']];
            $rules += [$locale . '.name' => ['required']];
            $rules += [$locale . '.description' => ['required']];

        }

        $request->validate($rules);
        $request_data = $request->except(['image', 'image_mobile']);

        if ($request->image) {

            $file = $request->file('image');

            $path = $file->hashName('public/slider_images');

            $image = Image::make($file);

            /*$image->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });*/

            Storage::put($path, (string) $image->encode());

            $request_data['image'] = $request->image->hashName();

        }//end of if

        if ($request->image_mobile) {

            $file = $request->file('image_mobile');

            $path = $file->hashName('public/slider_images');

            $image_mobile = Image::make($file);

            /*$image->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });*/

            Storage::put($path, (string) $image_mobile->encode());

            $request_data['image_mobile'] = $request->image_mobile->hashName();

        }//end of if

        //dd($request_data);

        Slider::create($request_data);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.sliders.index');

    }// end of store

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));

    }// end of edit

    public function update(Request $request, Slider $slider)
    {
        $rules = [];
        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.subhead' => ['required']];
            $rules += [$locale . '.name' => ['required']];
            $rules += [$locale . '.description' => 'required'];

        }

        $request->validate($rules);

        $request_data = $request->all();

        if ($request->image) {

            if ($slider->image != null) {

                Storage::delete('public/slider_images/' . $slider->image);

            }//end of if
            $file = $request->file('image');

            $path = $file->hashName('public/slider_images');

            $image = Image::make($file);

            Storage::put($path, (string) $image->encode());

            $request_data['image'] = $request->image->hashName();

        }//end of if

        if ($request->image_mobile) {

            if ($slider->image_mobile != null) {

                Storage::delete('public/slider_images/' . $slider->image_mobile);

            }//end of if
            $file = $request->file('image_mobile');

            $path = $file->hashName('public/slider_images');

            $image_mobile = Image::make($file);

            Storage::put($path, (string) $image_mobile->encode());

            $request_data['image_mobile'] = $request->image_mobile->hashName();

        }//end of if

        $slider->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.sliders.index');

    }// end of update

    public function destroy(Slider $slider)
    {
        if ($slider->image != null) {

            Storage::delete('public/slider_images/' . $slider->image);

        }//end of if
        $this->delete($slider);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $slider = Slider::FindOrFail($recordId);

            if ($slider->image != null) {

                Storage::delete('public/slider_images/' . $slider->image);

            }//end of if

            $this->delete($slider);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Slider $slider)
    {
        $slider->delete();

    }// end of delete
}
