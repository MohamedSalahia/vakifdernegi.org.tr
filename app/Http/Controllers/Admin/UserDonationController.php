<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserDonation;
use Asciisd\Knet\KnetTransaction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class UserDonationController extends Controller
{
    public function __construct()
    {

        $this->middleware('permission:read_user_donations')->only(['index']);
        $this->middleware('permission:create_user_donations')->only(['create', 'store']);
        $this->middleware('permission:update_user_donations')->only(['edit', 'update']);
        $this->middleware('permission:delete_user_donations')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {

        return view('admin.user_donations.index');

    }// end of index

    public function data()
    {
        //$user_donations = UserDonation::query()->with(['campaign', 'user'])->orderBy('created_at', 'desc')->select('user_donations.*');

        $knet_transactions = KnetTransaction::query()->whereNotNull('paymentid')->with(['campaign', 'user'])->orderBy('created_at', 'desc')->select('knet_transactions.*');


        //dd($user_donations);
        return DataTables::of($knet_transactions)
            ->addColumn('record_select', 'admin.user_donations.data_table.record_select')
            ->addColumn('actions', 'admin.user_donations.data_table.actions')
            ->addColumn('status', 'admin.user_donations.data_table.status')
            ->rawColumns(['record_select', 'actions', 'status'])
            ->toJson();

    }// end of data

    public function create()
    {

        $user_donations = UserDonation::all();
        return view('admin.user_donations.create', compact('user_donations'));

    }// end of create

    public function store(Request $request)
    {

        $rules = [];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required', Rule::unique('category_translations', 'name')]];

        }//end of for each

        $request->validate($rules);
        //$request->validated();

        UserDonation::create($request->all());

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.user_donations.index');

    }// end of store

    public function edit(UserDonation $userDonation)
    {
        $user_donations = UserDonation::where('id', '!=', $userDonation->id)->get();
        return view('admin.user_donations.edit', compact('userDonation', 'user_donations'));

    }// end of edit

    public function update(Request $request, UserDonation $userDonation)
    {
        dd('dsadas');
        $rules = [];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required']];

        }//end of for each

        $request->validate($rules);

        $userDonation->update($request->all());

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.user_donations.index');

    }// end of update

    public function destroy(UserDonation $category)
    {

        $this->delete($category);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $category = UserDonation::FindOrFail($recordId);

            $this->delete($category);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(UserDonation $category)
    {
        $category->delete();

    }// end of delete

    public function show(KnetTransaction $knetTransaction)
    {
        //dd($knetTransaction);

        return view('admin.user_donations.show', compact('knetTransaction'));
    }
}
