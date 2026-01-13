@extends('web.layout.default')
@section('content')

<div class="rts-wrapper">
    <div class="rts-wrapper-inner">

        <!-- header area start -->
        @include('web.includes.header')
        <!-- header area end -->

        <div class="rts-portfolio-area inner rts-section-gapNew">
            <div class="container">
                <div class="row g-5">

                    {{-- LEFT: Order details + items --}}
                    <div class="col-lg-6">

                        @include('cpanel.includes.alerts')

                        <div class="portfolio-details-area">

                            {{-- Page Title --}}
                            <h2 class="mb--30">
                                {{ __('web.Order Details') }} {{ $order->order_number }}
                            </h2>

                            <p class="mb--30">
                                {{ __('web.Here are your requested items with their details and attachments.') }}
                            </p>

                            {{-- Items list --}}
                            @foreach($order->items as $itemIndex => $item)
                                <div class="portfolio-details-area mb--40" style="border:1px solid #eee; border-radius:10px; padding:20px;">

                                    <h4 class="mb--20">
                                        {{ __('web.Item') }} {{ $itemIndex + 1 }}
                                    </h4>

                                    {{-- Item summary (labels) --}}
                                    <ul class="feature-list2" style="margin-bottom:15px;">
                                        <li>
                                            <i class="fa fa-car active"></i>
                                            <div class="text">
                                                <p>{{ __('web.Brand') }}/ {{ $item->brand?->name ?? '-' }}</p>
                                            </div>
                                        </li>

                                        <li>
                                            <i class="fa fa-cog active"></i>
                                            <div class="text">
                                                <p>{{ __('web.Model') }}/ {{ $item->model?->name ?? '-' }}</p>
                                            </div>
                                        </li>

                                        <li>
                                            <i class="fa fa-calendar active"></i>
                                            <div class="text">
                                                <p>{{ __('web.Make Year') }}/ {{ $item->year?->year ?? '-' }}</p>
                                            </div>
                                        </li>

                                        <li>
                                            <i class="fa fa-sort-numeric-up active"></i>
                                            <div class="text">
                                                <p>{{ __('web.Quantity') }}/ {{ $item->quantity }}</p>
                                            </div>
                                        </li>
                                    </ul>

                                    @if(!empty($item->description))
                                        <p class="mb--20">
                                            <strong>{{ __('web.Description') }}:</strong>
                                            {{ $item->description }}
                                        </p>
                                    @endif

                                    {{-- Images Slider (if exists) --}}
                                    @if($item->images && $item->images->count() > 0)
                                        <div class="portfolio-slider-area mb--20">
                                            <div class="swiper projectSlider4">
                                                <div class="swiper-wrapper">

                                                    @foreach($item->images as $img)
                                                        <div class="swiper-slide">
                                                            <div class="image">
                                                                <a href="{{ $img->url }}" target="_blank">
                                                                    <img src="{{ $img->url }}" width="450" alt="">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="mb--20" style="background:#f9f9f9;padding:15px;border-radius:10px;">
                                            <i class="far fa-image"></i>
                                            {{ __('web.No images uploaded for this item.') }}
                                        </div>
                                    @endif

                                </div>
                            @endforeach

                        </div>
                    </div>

                    {{-- RIGHT: Sidebar quotations --}}
                    <div class="col-lg-6">
                        <div class="sticky-top">
                            <div class="left-side-bar">

                                {{-- Order Overview --}}
                                <div class="overview side-box">
                                    <h2>{{ __('web.Order Overview') }}</h2>

                                    <ul class="feature-list2">
                                        <li>
                                            <i class="fa fa-info-circle active"></i>
                                            <div class="text">
                                                <p>{{ __('web.Status') }}</p>
                                                <p>{{ __('web.'.$order->status.'_status') }}</p>
                                            </div>
                                        </li>

                                        <li>
                                            <i class="fa fa-car active"></i>
                                            <div class="text">
                                                <p>{{ __('web.Items Count') }}</p>
                                                <p>{{ $order->items->count() }}</p>
                                            </div>
                                        </li>
                                        <li>
                                            <i class="fa fa-sort-numeric-up active"></i>
                                            <div class="text">
                                                <p>{{ __('web.Total Quantity') }}</p>
                                                <p>{{ $order->items->sum('quantity') }}</p>
                                            </div>
                                        </li>
                                         <li>
                                            <i class="fa fa-calendar active"></i>
                                            <div class="text">
                                                <p>{{ __('web.Order Date/Time') }}</p>
                                                <p>{{ date('Y-m-d h:i A', strtotime($order->created_at)) }}</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="price-area side-box">
                                    <h5>{{ __('web.Quotations List') }}</h5>

                                    @if($order->quotations->count() == 0)
                                        <p>{{ __('web.Waiting for quotations') }}</p>
                                    @else

                                        @foreach($order->quotations as $index => $quotation)
                                            @php
                                                $isApproved = ($quotation->status === 'ACCEPTED');
                                                $isRejected = ($quotation->status === 'REJECTED' || $quotation->status === 'DECLINED');
                                            @endphp

                                            <div class="one-offer"
                                                 @if($isRejected)
                                                     style="background-color:#f7e6e7 !important;padding:20px 10px 10px 10px;"
                                                 @elseif($isApproved)
                                                     style="background:#e4fee4 !important;padding:20px 10px 10px 10px;"
                                                 @else
                                                     style="padding:20px 10px 10px 10px;"
                                                 @endif
                                            >
                                                <h6 @if($isRejected) style="text-decoration-line: line-through;" @endif>
                                                    {{ __('web.Quotation #') }} {{ ++$index }}
                                                </h6>
                                                <ul class="col-12 row price-meta">
                                                    <li>
                                                        <i class="far fa-calendar active"></i>
                                                        {{ date('Y-m-d h:i A', strtotime($quotation->created_at)) }}
                                                    </li>
                                                </ul>

                                                {{-- Quote Items Table --}}
                                                <div style="margin-top:10px;">
                                                    @foreach($quotation->items as $qi)
                                                        @php
                                                            $reqItem = $qi->requestItem;
                                                        @endphp

                                                        <div style="border-top:1px dashed #ddd; padding-top:10px; margin-top:10px;">
                                                            <p style="margin-bottom:6px;">
                                                                <strong>
                                                                    {{ $reqItem?->brand?->name ?? '-' }}
                                                                    -
                                                                    {{ $reqItem?->model?->name ?? '-' }}
                                                                </strong>
                                                                <span class="float-end">
                                                                    {{ __('web.Quantity') }}: {{ $reqItem?->quantity ?? '-' }}
                                                                </span>
                                                            </p>

                                                            <p style="margin-bottom:6px;color:#666;">
                                                                {{ __('web.Make Year') }}: {{ $reqItem?->year?->year ?? '-' }}
                                                            </p>

                                                            <ul class="price-meta" style="margin-top:8px;">
                                                                <li>
                                                                    <i class="far fa-money-bill active"></i>
                                                                    {{ __('web.Unit Price') }}:
                                                                    {{ number_format($qi->unit_price, 2) }} {{ __('web.SAR') }}
                                                                </li>
                                                                <li>
                                                                    <i class="far fa-money-bill active"></i>
                                                                    {{ __('web.Total') }}:
                                                                    {{ number_format($qi->total_price, 2) }} {{ __('web.SAR') }}
                                                                </li>
                                                            </ul>

                                                            <ul class="price-meta">
                                                                <li>
                                                                    <i class="far fa-money-bill active"></i>
                                                                    {{ __('web.VAT Amount') }}:
                                                                    {{ number_format($qi->vat_amount, 2) }} {{ __('web.SAR') }}
                                                                </li>
                                                                <li>
                                                                    <i class="far fa-money-bill active"></i>
                                                                    {{ __('web.Total With VAT') }}:
                                                                    {{ number_format($qi->total_with_vat, 2) }} {{ __('web.SAR') }}
                                                                </li>
                                                            </ul>

                                                            @if(!empty($qi->description))
                                                                <p style="margin-top:8px;">
                                                                    {{ $qi->description }}
                                                                </p>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>

                                                {{-- Totals for quotation --}}
                                                <div style="border-top:1px solid #eee; padding-top:10px; margin-top:10px;">
                                                    <p style="margin:0;">
                                                        <strong>{{ __('web.Subtotal') }}:</strong>
                                                        <span class="float-end">{{ number_format($quotation->total_amount, 2) }} {{ __('web.SAR') }}</span>
                                                    </p>
                                                    <p style="margin:0;">
                                                        <strong>{{ __('web.VAT Amount') }}:</strong>
                                                        <span class="float-end">{{ number_format($quotation->vat_amount, 2) }} {{ __('web.SAR') }}</span>
                                                    </p>
                                                    <p style="margin:0;">
                                                        <strong>{{ __('web.Total With VAT') }}:</strong>
                                                        <span class="float-end">{{ number_format($quotation->total_with_vat, 2) }} {{ __('web.SAR') }}</span>
                                                    </p>
                                                </div>

                                                @if($order->user_id == auth()->id() && in_array($quotation->status, ['PENDING']))
                                                    <div class="row col-12" style="margin-top:15px;">
                                                        <div class="col-6 price-btn">
                                                            <button type="button"
                                                                    data-link="{{ route('my-orders.accept', $quotation->id) }}"
                                                                    data-id="{{ $quotation->id }}"
                                                                    class="rts-btn btn-primary radius-small accept-quotation">
                                                                {{ __('web.Accept') }}
                                                            </button>
                                                        </div>
                                                        <div class="col-6 price-btn">
                                                            <button type="button"
                                                                    data-link="{{ route('my-orders.decline', $quotation->id) }}"
                                                                    data-id="{{ $quotation->id }}"
                                                                    class="rts-btn btn-dark radius-small decline-quotation">
                                                                {{ __('web.Decline') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>
                                        @endforeach

                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>

                </div> {{-- row --}}
            </div> {{-- container --}}
        </div>

    </div>
</div>

@endsection


@push('scripts')
<script src="{{ asset('assets/web/js/sweetalert2@11.js') }}"></script>
<script>
    $(document).ready(function() {
        $('body').on('click', '.accept-offer', function() {
            var accept_link = $(this).attr("data-link");
            Swal.fire({
                title: "{{ __('web.Confirmation') }}",
                text: "{{ __('web.Are you sure you want to accept this offer') }}",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ __('web.Yes accept it') }}",
                cancelButtonText: "{{ __('web.Cancel') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = accept_link;
                }
            });
        });

        $('body').on('click', '.decline-offer', function() {
            var decline_link = $(this).attr("data-link");
            Swal.fire({
                title: "{{ __('web.Confirmation') }}",
                text: "{{ __('web.Are you sure you want to decline this offer') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ __('web.Yes decline it') }}",
                cancelButtonText: "{{ __('web.Cancel') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = decline_link;
                }
            });
        });
    });

</script>
@endpush
