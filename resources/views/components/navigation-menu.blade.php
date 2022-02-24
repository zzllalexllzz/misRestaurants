<nav class="navbar navbar-expand-md navbar-light bg-white border-bottom sticky-top mb-3">
    <div class="container">
        <!-- Logo -->
        @if (isset($logo))
            <a class="navbar-brand" href="/">
                <x-jet-application-mark width="36" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
        @endif

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            @if (isset($leftSideNavbar))
                {{ $leftSideNavbar }}
            @endif

            <!-- Right Side Of Navbar -->
            @if (isset($rightSideNavbar))
                {{ $rightSideNavbar }}
            @endif
        </div>
    </div>
</nav>
