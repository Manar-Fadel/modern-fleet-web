<!DOCTYPE html>
<html class="h-full" data-theme="true" data-theme-mode="light" lang="en">
<head>
    <title>
        Modern Fleet - Admin Cpanel
    </title>
    <meta charset="utf-8"/>
    <meta content="follow, index" name="robots"/>
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport"/>
    <meta content="summary_large_image" name="twitter:card"/>
    <meta content="en_US" property="og:locale"/>
    <meta content="website" property="og:type"/>
    <meta content="assets/media/app/og-image.png" property="og:image"/>
    <link rel="shortcut icon" href="{{ URL::asset('assets/title-image.PNG') }}" type="image/x-icon">
    <link href="{{ URL::asset("assets/title-image.PNG") }}" rel="shortcut icon"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="{{ URL::asset("assets/vendors/apexcharts/apexcharts.css") }}" rel="stylesheet"/>
    <link href="{{ URL::asset("assets/vendors/keenicons/styles.bundle.css") }}" rel="stylesheet"/>
    <link href="{{ URL::asset("assets/css/styles.css") }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ URL::asset("assets/css/metronic-fallback.css") }}">

    <script src="{{ URL::asset("assets/js/jquery/jquery.min.js")}}"></script>
</head>
<body class="antialiased flex h-full text-base text-gray-700 [--tw-page-bg:#fefefe] [--tw-page-bg-dark:var(--tw-coal-500)] demo1 sidebar-fixed header-fixed bg-[--tw-page-bg] dark:bg-[--tw-page-bg-dark]">
<input type="hidden" name="auth_token" id="auth_token" value="{{ \Illuminate\Support\Facades\Session::get('auth_token') }}">
<!-- Theme Mode -->
<style>
    .bgdangerlight {
        background-color: var(--tw-danger-light) !important;
    }
    .displayactive{
        display: block !important;
    }
    .yellow{
        background-color: #ffffc3;
    }
    .orange{
        background-color: #ffe4b3;
    }
    .red{
        background-color: var(--tw-danger-light);
    }
    .green{
        background-color: #c2ffc2;
    }
</style>
<script>
    const defaultThemeMode = 'light'; // light|dark|system
    let themeMode;

    if ( document.documentElement ) {
        if ( localStorage.getItem('theme')) {
            themeMode = localStorage.getItem('theme');
        } else if ( document.documentElement.hasAttribute('data-theme-mode')) {
            themeMode = document.documentElement.getAttribute('data-theme-mode');
        } else {
            themeMode = defaultThemeMode;
        }

        if (themeMode === 'system') {
            themeMode = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        }

        document.documentElement.classList.add(themeMode);
    }
</script>
<!-- End of Theme Mode -->
<!-- Page -->
<!-- Main -->
<div class="flex grow">
    <input type="hidden" value="{{ auth()->user()->id }}" name="tashleeh_user_id" id="tashleeh_user_id">
    @include("cpanel.includes.sidebar")

    <!-- Wrapper -->
    <div class="wrapper flex grow flex-col">
        @include("cpanel.includes.header")
        @yield("content")
        @include("cpanel.includes.footer")
    </div>
</div>
<!-- End of Main -->

<script src="{{ URL::asset("assets/js/core.bundle.js") }}"></script>
<script src="{{ URL::asset("assets/vendors/apexcharts/apexcharts.min.js") }}"></script>
<script src="{{ URL::asset("assets/js/layouts/demo1.js") }}"></script>
<script src="{{ URL::asset("assets/js/widgets/general.js") }}"></script>
@stack('scripts')
</body>
</html>
