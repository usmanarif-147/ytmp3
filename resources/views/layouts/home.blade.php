<!doctype html>
<html lang="en">

<head>
    <title>YouTube Downloader - YTMP3</title>

    @include('livewire.home.partials.meta-information')

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link data-n-head="ssr" rel="icon" type="image/x-icon" href="/favicon.ico">
    <link data-n-head="ssr" rel="canonical" href="https://ytmp3.ch/en11/">
    <link data-n-head="ssr" rel="preconnect" href="https://backend.myconverters.com/">
    <link data-n-head="ssr" rel="preload" as="image" href="/assets/images/common/1x_m/icon.png?t=1685526167776">
    <link rel="stylesheet" href="{{ asset('home/assets/custom.css') }}">

    @livewireStyles
</head>

<body>

    <div>
        <div id="__layout">
            <div class="default-wrapper pc-wrap domain_y3h">

                {{ $slot }}

            </div>
        </div>
    </div>



    <script src="{{ asset('home/assets/custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    @livewireScripts
</body>

</html>
