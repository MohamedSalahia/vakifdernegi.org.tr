<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/** Admin: help centre questions ("Sıkça Sorulan Sorular"). */
class FaqController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_settings');
    }

    public function index()
    {
        $faqs = Faq::orderBy('category')->orderBy('sort_order')->orderBy('id')->get();

        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faqs.form', ['faq' => new Faq(['category' => 'general', 'is_active' => true, 'sort_order' => (int) Faq::max('sort_order') + 1])]);
    }

    public function store(Request $request)
    {
        Faq::create($this->validated($request));
        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('admin.faqs.index');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faqs.form', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $faq->update($this->validated($request));
        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('admin.faqs.index');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        session()->flash('success', __('site.deleted_successfully'));

        return redirect()->route('admin.faqs.index');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'category' => ['required', Rule::in(Faq::CATEGORIES)],
            'question_tr' => 'required|string|max:500',
            'question_ar' => 'nullable|string|max:500',
            'answer_tr' => 'required|string|max:10000',
            'answer_ar' => 'nullable|string|max:10000',
            'sort_order' => 'nullable|integer|min:0|max:9999',
        ], [], ['question_tr' => __('site.faq_question') . ' (TR)', 'answer_tr' => __('site.faq_answer') . ' (TR)']);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
