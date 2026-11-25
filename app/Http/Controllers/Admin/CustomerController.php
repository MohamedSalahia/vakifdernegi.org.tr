<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerTranslation;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_customers')->only(['index']);
        $this->middleware('permission:create_customers')->only(['create', 'store']);
        $this->middleware('permission:update_customers')->only(['edit', 'update']);
        $this->middleware('permission:delete_customers')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.customers.index');

    }// end of index

    public function data()
    {
        $customers = Customer::orderBy('created_at', 'desc')->get();

        return DataTables::of($customers)
            ->addColumn('record_select', 'admin.customers.data_table.record_select')
            ->addColumn('actions', 'admin.customers.data_table.actions')
            ->addColumn('images', 'admin.customers.data_table.images')
            ->rawColumns(['record_select', 'actions', 'images'])
            ->toJson();




    }// end of data

    public function create()
    {
        $categories = Category::all();
        return view('admin.customers.create', compact('categories'));

    }// end of create

    public function store(Request $request)
    {
        $rules = [

        ];
        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required', Rule::unique('customer_translations', 'name')]];
            $rules += [$locale . '.job' => ['required']];
            $rules += [$locale . '.comment' => ['required']];

        }//end of for each

        $request->validate($rules);
        $request_data = $request->except(['image']);

        if ($request->image) {

            $file = $request->file('image');

            $path = $file->hashName('public/customer_images');

            $image = Image::make($file);

            /*$image->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });*/

            Storage::put($path, (string) $image->encode());

            $request_data['image'] = $request->image->hashName();

        }//end of if

        //dd($request_data);

        Customer::create($request_data);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.customers.index');

    }// end of store

    public function edit(Customer $customer)
    {
        $categories = Category::all();
        return view('admin.customers.edit', compact('customer', 'categories'));

    }// end of edit

    public function update(Request $request, Customer $customer)
    {
        $rules = [
            /*'category_id' => 'required'*/
        ];
        //dd($customer->id);
        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required'/*, Rule::unique('customer_translations', 'name')->ignore($customer->id, 'customer_id')*/]];
            $rules += [$locale . '.job' => ['required']];
            $rules += [$locale . '.comment' => ['required']];

        }//end of  for each

        $request->validate($rules);

        $request_data = $request->all();

        if ($request->image) {

            if ($customer->image != null) {

                Storage::delete('public/customer_images/' . $customer->image);

            }//end of if
            $file = $request->file('image');

            $path = $file->hashName('public/customer_images');

            $image = Image::make($file);

            Storage::put($path, (string) $image->encode());

            $request_data['image'] = $request->image->hashName();

        }//end of if

        $customer->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.customers.index');

    }// end of update

    public function destroy(Customer $customer)
    {
        if ($customer->image != null) {

            Storage::delete('public/customer_images/' . $customer->image);

        }//end of if
        $this->delete($customer);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $customer = Customer::FindOrFail($recordId);

            if ($customer->image != null) {

                Storage::delete('public/customer_images/' . $customer->image);

            }//end of if

            $this->delete($customer);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Customer $customer)
    {
        $customer->delete();

    }// end of delete

    public function show(Customer $customer)
    {
        $categories = Category::all();
        return view('web.customer', compact(['customer', 'categories']));

    }// end of delete
}
