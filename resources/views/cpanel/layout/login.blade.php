<!DOCTYPE html>
<html class="h-full" data-theme="true" data-theme-mode="light" lang="en">
<head>
    <title>
        Radar - Admin Cpanel
    </title>
    <meta charset="utf-8"/>
    <meta content="website" property="og:type"/>
    <link rel="shortcut icon" href="{{ URL::asset('assets/title-image.PNG') }}" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="{{ URL::asset("assets/vendors/apexcharts/apexcharts.css") }}" rel="stylesheet"/>
    <link href="{{ URL::asset("assets/vendors/keenicons/styles.bundle.css") }}" rel="stylesheet"/>
    <link href="{{ URL::asset("assets/css/styles.css") }}" rel="stylesheet"/>
</head>
<body class="antialiased flex h-full text-base text-gray-700 dark:bg-coal-500">
<!-- Theme Mode -->
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
<style>
    .page-bg {
        background-size: cover;
        background-image: url({{ URL::asset('assets/web/images/video-banner.webp') }});
    }
    .dark .page-bg {
        background-image: url({{ URL::asset('assets/web/images/video-banner.webp') }});
    }
</style>
<div class="flex items-center justify-center grow bg-center bg-no-repeat page-bg">

    @yield("content")
</div>
<!-- End of Page -->
<!-- Scripts -->
<script src="{{ URL::asset("assets/js/core.bundle.js") }}></script>
<script src="{{ URL::asset("assets/vendors/apexcharts/apexcharts.min.js") }}></script>
<!-- End of Scripts -->
</body>
</html>

