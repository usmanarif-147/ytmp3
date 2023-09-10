    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>{{ $data['meta_title'] }} </title>
    <meta name="description" content="{{ $data['meta_description'] }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="robots" content="{{ $data['robots'] }}">

    <meta itemprop="name" content="{{ $data['item_prop_name'] }}" />
    <meta itemprop="description" content="{{ $data['item_prop_description'] }}" />
    <meta itemprop="image" content="{{ $data['item_prop_image'] }}" />
    <meta property="og:type" content="{{ $data['og_type'] }}" />
    <meta property="og:title" content="{{ $data['og_title'] }}" />
    <meta property="og:description" content="{{ $data['og_description'] }}" />
    <meta property="og:image" content="{{ $data['og_image'] }}" />
    <link rel="canonical" href="{{ $data['canonical'] }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link data-n-head="ssr" rel="icon" type="image/x-icon" href="/favicon.ico">
    {{-- <link data-n-head="ssr" rel="canonical" href="https://ytmp3.ch/en11/"> --}}
    {{-- <link data-n-head="ssr" rel="preconnect" href="https://backend.myconverters.com/"> --}}
    {{-- <link data-n-head="ssr" rel="preload" as="image" href="/assets/images/common/1x_m/icon.png?t=1685526167776"> --}}
    <link rel="stylesheet" href="{{ asset('home/assets/custom.css') }}">
    @livewireStyles
