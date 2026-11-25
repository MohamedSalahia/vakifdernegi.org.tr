@extends('layouts.web.app')
@section('page_title')@lang('site.zakat')@endsection
@section('content')
    <script src="{{asset('web/js/jquery.js')}}"></script>

    <section class="payment-donate-section-two">
        <div class="sec-bg-one" style="background-image: url({{url('/thumbnail/675/650/80/storage/settings/'.setting('zakat'))}});"></div>
        <div class="sec-bg-two" style="background-image: url({{asset('web/images/background/bg-11.jpg')}});"></div>
        <div class="auto-container">
            <div class="row">
                <div class="col-xl-9 offset-xl-3">
                    <div class="row align-items-center">
                        {{--<div class="col-lg-4 order-lg-2">
                            <ul class="nav nav-tabs tab-btn-style-one" role="tablist">
                                <li class="nav-item wow fadeInUp animated" data-wow-delay=".8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInUp;">
                                    <a class="nav-link active" id="tab-one-six" data-toggle="tab" href="#tab-one" role="tab" aria-controls="tab-one" aria-selected="false">
                                        <h4>صدقات</h4>
                                    </a>
                                </li>
                                <li class="nav-item wow fadeInUp animated" data-wow-delay=".8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInUp;">
                                    <a class="nav-link " id="tab-two-area" data-toggle="tab" href="#tab-two" role="tab" aria-controls="tab-two" aria-selected="true">
                                        <h4>زكاة</h4>
                                    </a>
                                </li>
                                <li class="nav-item wow fadeInUp animated" data-wow-delay=".8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInUp;">
                                    <a class="nav-link " id="tab-three-area" data-toggle="tab" href="#tab-three" role="tab" aria-controls="tab-three" aria-selected="true">
                                        <h4>كفارة يمين</h4>
                                    </a>
                                </li>
                                <li class="nav-item wow fadeInUp animated" data-wow-delay=".8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInUp;">
                                    <a class="nav-link " id="tab-four-area" data-toggle="tab" href="#tab-four" role="tab" aria-controls="tab-four" aria-selected="true">
                                        <h4>كفارة صيام</h4>
                                    </a>
                                </li>
                                <li class="nav-item wow fadeInUp animated" data-wow-delay=".8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInUp;">
                                    <a class="nav-link " id="tab-five-area" data-toggle="tab" href="#tab-five" role="tab" aria-controls="tab-five" aria-selected="true">
                                        <h4>نذور</h4>
                                    </a>
                                </li>
                            </ul>
                        </div>--}}
                        <div class="col-lg-12">
                            <!-- Tab panes -->
                            <div class="tab-content">

                                <h1>@lang('site.zakat_hadith_intro')</h1>
                                <div class="text">
                                    @lang('site.zakat_hadith')
                                </div>
                                <form method="get" action="{{route('donate.zakat')}}">
                                        <ul class="chicklet-list clearfix text-center">
                                            <li>
                                                <input type="radio" id="sadaka" name="typeOfDonate" value="sadaka" checked="checked">
                                                <label for="sadaka">@lang('site.sadaka')</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="zakat" name="typeOfDonate" value="zakat">
                                                <label for="zakat">@lang('site.zakat_type')</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="kfaratYamin" name="typeOfDonate" value="kfaratYamin">
                                                <label for="kfaratYamin">@lang('site.kfaratYamin')</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="kfaratSiyam" name="typeOfDonate" value="kfaratSiyam">
                                                <label for="kfaratSiyam">@lang('site.kfaratSiyam')</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="nzr" name="typeOfDonate" value="nzr">
                                                <label for="nzr">@lang('site.nzr')</label>
                                            </li>
                                            <li>
                                                <input type="number" min="5" name="price" class="price" placeholder="@lang('site.amount_placeholder')" required>
                                            </li>
                                        </ul>
                                        <div class="other-amount d-flex align-items-center">
                                            <button class="theme-btn btn-style-two" style="background: #604120;" type="submit"><span class="flaticon-heart-1"></span><span> @lang('site.direct_donation')</span></button>
                                        </div>

                                    </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @endsection

    @push('scripts')
    {{--<script>
        $(function() {

            $("input:radio[name=amount]").on("click",function() {
                var amount = $("input:radio[name=amount]:checked").val();
                $('#textAmount').val(amount);
            });
        });
    </script>--}}
@endpush
