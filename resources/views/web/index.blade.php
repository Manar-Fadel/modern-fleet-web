@extends('web.layout.default')
@section('content')

<div class="rts-wrapper">
    <div class="rts-wrapper-inner">
        <!-- header area start -->
        @include("web.includes.header")
        <!-- header area end -->

        <!-- Banner area start -->
        @include("web.includes.banner")
        <!-- Banner area end -->

        <!-- About Area Start -->
        @include("web.includes.about")
        <!-- About Area End -->

        <!-- Category Area Start -->
        @include("web.includes.categories")
        <!-- Category Area End -->

        <!-- Portfolio Area Start -->
        @include("web.includes.stocks")
        <!-- Portfolio Area End -->

        <!-- Counter Area Start -->
        @include("web.includes.counter")
        <!-- Counter Area End -->

        <!-- Why Choose Us Area Start -->
        @include("web.includes.why-us")
        <!-- Why Choose Us Area End -->

        <!-- Brand Area Start -->
        @include("web.includes.brands")
        <!-- Brand Area End -->

        <!-- Popular Car Area Start -->
        @include("web.includes.heavy-vehicles-stock")
        <!-- Popular Car Area End -->

        <!-- Newsletter Area Start -->
        @include("web.includes.newsletter", ['local' => $local])
        <!-- Newsletter Area End -->
    </div>
</div>

@endsection
