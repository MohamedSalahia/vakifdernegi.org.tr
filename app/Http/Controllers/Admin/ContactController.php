<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_contacts')->only(['index']);
        $this->middleware('permission:create_contacts')->only(['create', 'store']);
        $this->middleware('permission:update_contacts')->only(['edit', 'update']);
        $this->middleware('permission:delete_contacts')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.contacts.index');

    }// end of index

    public function data()
    {
        $contacts = Contact::get();

        return DataTables::of($contacts)
            ->addColumn('record_select', 'admin.contacts.data_table.record_select')
            ->addColumn('actions', 'admin.contacts.data_table.actions')
            ->addColumn('images', 'admin.contacts.data_table.images')
            ->rawColumns(['record_select', 'actions', 'images'])
            ->toJson();




    }// end of data

    public function destroy(Contact $contact)
    {
        if ($contact->image != 'default.png') {

            Storage::delete('public/contact_images/' . $contact->image);

        }//end of if
        $this->delete($contact);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $contact = Contact::FindOrFail($recordId);

            $this->delete($contact);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Contact $contact)
    {
        $contact->delete();

    }// end of delete

    public function show($id)
    {

        $contact = Contact::where('id', '=', $id)->get();
        return view('admin.contacts.show', compact('contact'));

    }// end of delete
}
