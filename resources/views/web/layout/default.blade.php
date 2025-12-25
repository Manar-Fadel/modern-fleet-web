<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset("assets/web/images/fav.png") }}">
    <title>
        Modern Fleet | مودرن فليت منصة لبيع السيارات والمركبات الثقيلة في المملكة العربية السعودية
    </title>

    <meta property="og:image" content="https://modernfleet.sa/logo.png">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="ar_SA">

    <link rel="stylesheet" href="{{ URL::asset("assets/web/css/plugins/plugins.css") }}">
    <link rel="stylesheet" href="{{ URL::asset("assets/web/css/plugins/magnifying-popup.css") }}">
    <link rel="stylesheet" href="{{ URL::asset("assets/web/css/vendor/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ URL::asset("assets/web/fonts/rt-icon.css") }}">
    <link rel="stylesheet" href="{{ URL::asset("assets/web/css/style.css") }}">
    <link rel="stylesheet" href="{{ URL::asset("assets/web/css/custom-style.css") }}">
    <link rel="stylesheet" href="{{ URL::asset("assets/web/css/toaster.css") }}">
</head>

<body @if(request()->route()->getName() == "login" || request()->route()->getName() == "register"
          || request()->route()->getName() == "profile"
          || request()->route()->getName() == "password.request" || request()->route()->getName() == "password.reset")
          class="account-page-body"
      @elseif(request()->route()->getName() == "my-orders")
          class="with-sidebar"
      @endif
      @if(app()->getLocale() == 'ar') style="direction: rtl;" @endif>

<div id="toast-container"></div>
<div id="app">
    <div class="loader-wrapper">
        <div class="loader">
        </div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>

    @yield("content")
</div>

<script src="{{ URL::asset("assets/web/js/plugins/jquery.js") }}"></script>
<script src="{{ URL::asset("assets/web/js/plugins/jquery-ui.js") }}"></script>
<script src="{{ URL::asset("assets/web/js/vendor/waw.js") }}"></script>
<script src="{{ URL::asset("assets/web/js/plugins/counter-up.js") }}"></script>
<script src="{{ URL::asset("assets/web/js/plugins/contact-form.js") }}"></script>
<script src="{{ URL::asset("assets/web/js/plugins/swiper.js") }}"></script>
<script src="{{ URL::asset("assets/web/js/plugins/metismenu.js") }}"></script>
<script src="{{ URL::asset("assets/web/js/vendor/jarallax.js") }}"></script>
<script src="{{ URL::asset("assets/web/js/plugins/smooth-scroll.js") }}"></script>
<script src="{{ URL::asset("assets/web/js/plugins/magnifying-popup.js") }}"></script>
<script src="{{ URL::asset("assets/web/js/vendor/bootstrap.min.js") }}"></script>
<script src="{{ URL::asset("assets/web/js/vendor/waypoint.js") }}"></script>
<!-- main js here -->
<script src="{{ URL::asset("assets/web/js/main.js") }}"></script>
<script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
<script>
    Pusher.logToConsole = true;
    var pusher = new Pusher('ce1afbee35ce16637822', {
        cluster: 'ap2'
    });
    var channel = pusher.subscribe('new-order');
    channel.bind('new-order-event', function(data) {
        var messageData = JSON.stringify(data);
        if($('#new_orders_count').length != 0) {
            $('#new_orders_count').removeClass('hidden');
            var val = parseInt($('#new_orders_count').text());
            if (val >= 1) {
                $('#new_orders_count').html(val + 1);
            }else{
                $('#new_orders_count').html(1);
            }
        }
        showToast(data.message+': '+data.order_description, 'success')
    });

    function showToast(message, type = "success") {
        const toastContainer = document.getElementById("toast-container");

        const toast = document.createElement("div");
        toast.classList.add("toast");
        toast.classList.add(type); // Add 'success' or 'error' class
        toast.innerText = message;

        toastContainer.appendChild(toast);

        // Show the toast
        setTimeout(() => {
            toast.classList.add("show");
        }, 100); // Small delay for CSS transition to work

        // Hide and remove the toast after a few seconds
        setTimeout(() => {
            toast.classList.remove("show");
            setTimeout(() => toast.remove(), 500); // Remove after fade-out
        }, 30000); // Display for 3 seconds
    }

</script>

@stack('scripts')
</body>

</html>
