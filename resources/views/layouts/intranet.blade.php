<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

    <!-- Font awesome icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('components.sidebar-menu')


        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- Topbar -->
                <x-navigation-menu>
                    <x-slot name="rightSideNavbar">
                        @include('components.right-side-navbar')
                    </x-slot>
                </x-navigation-menu>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    @if (isset($header))
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            {{ $header }}
                        </div>
                    @endif

                    <!-- Content -->
                    {{ $slot }}

                </div>
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright © 2021 All Rights Reserved by Rasma Butkute</span>
                    </div>
                </div>

            </footer>
        </div>
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    @stack('modals')
    @livewireScripts
    @stack('scripts')

    <script type="text/javascript">
        window.livewire.on('modalSave', () => {
            $('.submitModal').attr('data-dismiss', 'modal');
            $('#openModal').modal('hide');
        });

        window.livewire.on('modalOpen', () => {
            $('.submitModal').removeAttr('data-dismiss', 'modal');
        });

    </script>

</body>

</html>
