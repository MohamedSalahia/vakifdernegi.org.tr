<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class SubscribeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_subscribes')->only(['index']);
        $this->middleware('permission:create_subscribes')->only(['create', 'store']);
        $this->middleware('permission:update_subscribes')->only(['edit', 'update']);
        $this->middleware('permission:delete_subscribes')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.subscribes.index');

    }// end of index

    public function data()
    {
        $subscribes = Subscribe::get();

        return DataTables::of($subscribes)
            ->addColumn('record_select', 'admin.subscribes.data_table.record_select')
            ->addColumn('actions', 'admin.subscribes.data_table.actions')
            ->rawColumns(['record_select', 'actions', 'images'])
            ->toJson();




    }// end of data

    public function destroy(Subscribe $subscribe)
    {
        $this->delete($subscribe);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $subscribe = Subscribe::FindOrFail($recordId);

            $this->delete($subscribe);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Subscribe $subscribe)
    {
        $subscribe->delete();

    }// end of delete

    public function show($id)
    {

        $subscribe = Subscribe::where('id', '=', $id)->get();
        return view('admin.subscribes.show', compact('subscribe'));

    }// end of delete
}
