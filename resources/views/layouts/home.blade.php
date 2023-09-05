<!doctype html>
<html lang="{{ $data['lang'] }}">

<head>
    @include('livewire.home.partials.meta-information')
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
