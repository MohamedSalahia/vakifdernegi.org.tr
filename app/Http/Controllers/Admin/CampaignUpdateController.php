<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\CampaignUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Admin: news/progress updates of a campaign ("Son Gelişmeler" tab on the campaign page).
 */
class CampaignUpdateController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:update_campaigns');
    }

    public function index(Campaign $campaign)
    {
        $updates = $campaign->updates()->get();
        $editing = null;

        return view('admin.campaign_updates.index', compact('campaign', 'updates', 'editing'));
    }

    public function edit(Campaign $campaign, CampaignUpdate $update)
    {
        abort_unless($update->campaign_id === $campaign->id, 404);
        $updates = $campaign->updates()->get();
        $editing = $update;

        return view('admin.campaign_updates.index', compact('campaign', 'updates', 'editing'));
    }

    public function store(Request $request, Campaign $campaign)
    {
        $data = $this->validated($request);
        $data['image'] = $this->storeImage($request);
        $campaign->updates()->create($data);

        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('admin.campaigns.updates.index', $campaign);
    }

    public function update(Request $request, Campaign $campaign, CampaignUpdate $update)
    {
        abort_unless($update->campaign_id === $campaign->id, 404);
        $data = $this->validated($request);

        if ($request->hasFile('image')) {
            $this->deleteImage($update->image);
            $data['image'] = $this->storeImage($request);
        } elseif ($request->boolean('remove_image')) {
            $this->deleteImage($update->image);
            $data['image'] = null;
        }
        $update->update($data);

        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('admin.campaigns.updates.index', $campaign);
    }

    public function destroy(Campaign $campaign, CampaignUpdate $update)
    {
        abort_unless($update->campaign_id === $campaign->id, 404);
        $this->deleteImage($update->image);
        $update->delete();

        session()->flash('success', __('site.deleted_successfully'));

        return redirect()->route('admin.campaigns.updates.index', $campaign);
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title_tr' => 'required|string|max:255',
            'title_ar' => 'nullable|string|max:255',
            'body_tr' => 'required|string|max:10000',
            'body_ar' => 'nullable|string|max:10000',
            'published_at' => 'required|date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ], [], [
            'title_tr' => __('site.update_title') . ' (TR)', 'title_ar' => __('site.update_title') . ' (AR)',
            'body_tr' => __('site.update_body') . ' (TR)', 'body_ar' => __('site.update_body') . ' (AR)',
            'published_at' => __('site.update_date'), 'image' => __('site.image'),
        ]);
    }

    private function storeImage(Request $request): ?string
    {
        if (!$request->hasFile('image')) {
            return null;
        }

        return basename($request->file('image')->store('campaign_updates', 'public'));
    }

    private function deleteImage(?string $file): void
    {
        if ($file) {
            Storage::disk('public')->delete('campaign_updates/' . $file);
        }
    }
}
