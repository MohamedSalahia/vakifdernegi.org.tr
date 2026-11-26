@php
    $shareUrl = route('campaign.show', [$campaign->id, make_slug($campaign->name)]);
    $shareText = $campaign->name;
@endphp
<div class="vk-share" data-share-url="{{ route('campaign.share', $campaign->id) }}">
    <span class="vk-share__label">@lang('site.share_campaign'):</span>
    <a class="wa" href="https://wa.me/?text={{ urlencode($shareText.' '.$shareUrl) }}" target="_blank" rel="noopener" aria-label="WhatsApp"><span class="fa fa-whatsapp"></span></a>
    <a class="fb" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }}" target="_blank" rel="noopener" aria-label="Facebook"><span class="fa fa-facebook"></span></a>
    <a class="tw" href="https://twitter.com/intent/tweet?text={{ urlencode($shareText) }}&url={{ urlencode($shareUrl) }}" target="_blank" rel="noopener" aria-label="X"><span class="fa fa-twitter"></span></a>
    <a class="tg" href="https://t.me/share/url?url={{ urlencode($shareUrl) }}&text={{ urlencode($shareText) }}" target="_blank" rel="noopener" aria-label="Telegram"><span class="fa fa-telegram"></span></a>
    <button type="button" class="cp" data-copy="{{ $shareUrl }}" aria-label="@lang('site.copy_link')"><span class="fa fa-link"></span></button>
    <span class="vk-share__count"><span class="vk-share-count">{{ $campaign->share_count }}</span> @lang('site.shares')</span>
</div>
@push('scripts')
<script>
    (function () {
        var bar = document.querySelector('.vk-share');
        if (!bar) return;
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        function track() {
            fetch(bar.dataset.shareUrl, { method: 'POST', credentials: 'same-origin', headers: { 'X-CSRF-TOKEN': token, 'Accept': 'application/json' } })
                .then(function (r) { return r.ok ? r.json() : null; })
                .then(function (b) { if (b && typeof b.count !== 'undefined') bar.querySelector('.vk-share-count').textContent = b.count; })
                .catch(function () {});
        }
        bar.querySelectorAll('a').forEach(function (a) { a.addEventListener('click', track); });
        bar.querySelector('.cp').addEventListener('click', function () {
            var url = this.dataset.copy;
            (navigator.clipboard ? navigator.clipboard.writeText(url) : Promise.reject()).then(function () {
                vakifToast(@json(__('site.link_copied')), 'success');
            }).catch(function () { window.prompt(@json(__('site.copy_link')), url); });
            track();
        });
    })();
</script>
@endpush
