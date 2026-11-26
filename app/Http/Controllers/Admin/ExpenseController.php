<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/** Admin: money spent ("Harcamalar"), shown on the public transparency page when public. */
class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:update_user_donations');
    }

    public function index()
    {
        $expenses = Expense::with('campaign')->orderByDesc('spent_at')->orderByDesc('id')->paginate(30);
        $total = Expense::sum('amount');

        return view('admin.expenses.index', compact('expenses', 'total'));
    }

    public function create()
    {
        return view('admin.expenses.form', ['expense' => new Expense(['spent_at' => now(), 'is_public' => true]), 'campaigns' => $this->campaigns()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['document'] = $this->storeFile($request);
        Expense::create($data);
        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('admin.expenses.index');
    }

    public function edit(Expense $expense)
    {
        return view('admin.expenses.form', ['expense' => $expense, 'campaigns' => $this->campaigns()]);
    }

    public function update(Request $request, Expense $expense)
    {
        $data = $this->validated($request);
        if ($request->hasFile('document')) {
            $this->deleteFile($expense->document);
            $data['document'] = $this->storeFile($request);
        } elseif ($request->boolean('remove_document')) {
            $this->deleteFile($expense->document);
            $data['document'] = null;
        }
        $expense->update($data);
        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('admin.expenses.index');
    }

    public function destroy(Expense $expense)
    {
        $this->deleteFile($expense->document);
        $expense->delete();
        session()->flash('success', __('site.deleted_successfully'));

        return redirect()->route('admin.expenses.index');
    }

    private function campaigns()
    {
        return Campaign::withTrashed()->with('translations')->orderByDesc('id')->get();
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'spent_at' => 'required|date',
            'amount' => 'required|numeric|min:0.01|max:100000000',
            'campaign_id' => 'nullable|integer|exists:campaigns,id',
            'title_tr' => 'required|string|max:255',
            'title_ar' => 'nullable|string|max:255',
            'description_tr' => 'nullable|string|max:5000',
            'description_ar' => 'nullable|string|max:5000',
            'document' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:10240',
        ], [], [
            'spent_at' => __('site.update_date'), 'amount' => __('site.price'), 'title_tr' => __('site.update_title') . ' (TR)',
        ]);
        $data['is_public'] = $request->boolean('is_public');
        unset($data['document']);

        return $data;
    }

    private function storeFile(Request $request): ?string
    {
        return $request->hasFile('document') ? basename($request->file('document')->store('expense_documents', 'public')) : null;
    }

    private function deleteFile(?string $file): void
    {
        if ($file) {
            Storage::disk('public')->delete('expense_documents/' . $file);
        }
    }
}
