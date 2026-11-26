{{-- Home page quick donation (admin: Bağış Ayarları > Hızlı bağış) --}}
@php
    $qdCampaigns = \App\Models\Campaign::query()->where('status', 'active')->where('complete', 'no')
        ->with('translations')->orderByDesc('is_urgent')->latest('id')->get();
    $qdPresets = \App\Support\DonationSettings::presets();
    $qdMin = \App\Support\DonationSettings::min();
@endphp
<section class="vk-quick" id="quick-donate">
    <div class="auto-container">
        <form method="get" action="{{ route('donate.quick') }}" class="vk-quick__box" id="vk-quick-form">
            <h3 class="vk-quick__title"><span class="fa fa-heart"></span> @lang('site.quick_donate')</h3>
            <div class="vk-quick__grid">
                <div class="vk-quick__field">
                    <label for="qd-target">@lang('site.quick_donate_where')</label>
                    <select id="qd-target" name="target" class="form-control" required>
                        <optgroup label="@lang('site.zakat_and_sadaka')">
                            @foreach(\App\Http\Controllers\DonationController::ZAKAT_TYPES as $type)
                                <option value="type:{{ $type }}">{{ \App\Http\Controllers\DonationController::typeLabel($type) }}</option>
                            @endforeach
                        </optgroup>
                        @if($qdCampaigns->isNotEmpty())
                            <optgroup label="@lang('site.campaigns')">
                                @foreach($qdCampaigns as $c)
                                    <option value="campaign:{{ $c->id }}" {{ $loop->first && $c->is_urgent ? 'selected' : '' }}>{{ $c->is_urgent ? '⚡ ' : '' }}{{ $c->name }}</option>
                                @endforeach
                            </optgroup>
                        @endif
                    </select>
                </div>
                <div class="vk-quick__field">
                    <label>@lang('site.donation_amount')</label>
                    <div class="vk-quick__presets">
                        @foreach($qdPresets as $p)
                            <button type="button" class="vk-chip {{ $loop->index === 1 ? 'active' : '' }}" data-amount="{{ $p }}" dir="ltr">{{ number_format($p, 0, ',', '.') }} TL</button>
                        @endforeach
                        <input type="number" name="amount" id="qd-amount" class="form-control vk-quick__custom" min="{{ $qdMin }}" step="1" required
                               value="{{ $qdPresets[1] ?? $qdPresets[0] }}" aria-label="@lang('site.donation_amount')" placeholder="@lang('site.another_require')">
                    </div>
                </div>
                <div class="vk-quick__field vk-quick__submit">
                    <button type="submit" class="theme-btn btn-style-one"><span>@lang('site.donate_now')</span></button>
                </div>
            </div>
        </form>
    </div>
</section>
@push('scripts')
<script>
    (function () {
        var form = document.getElementById('vk-quick-form');
        if (!form) return;
        var input = document.getElementById('qd-amount');
        form.querySelectorAll('.vk-chip').forEach(function (chip) {
            chip.addEventListener('click', function () {
                form.querySelectorAll('.vk-chip').forEach(function (c) { c.classList.remove('active'); });
                chip.classList.add('active');
                input.value = chip.dataset.amount;
            });
        });
        input.addEventListener('input', function () {
            form.querySelectorAll('.vk-chip').forEach(function (c) { c.classList.toggle('active', c.dataset.amount === input.value); });
        });
    })();
</script>
@endpush
