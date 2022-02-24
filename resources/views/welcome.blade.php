<x-guest-layout>
    <div class="container-fluid m-0 p-0 welcome-container">
        <header class="d-flex px-4 justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <a class="navbar-brand" href="/">
                    <x-jet-application-mark />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            @if (Route::has('login'))
                <div>
                    @auth
                        <a href="{{ url('main') }}" class="text-muted">Main</a>
                    @else
                        <a href="{{ route('login') }}" class="text-muted">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-muted">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </header>


        <section>
            <div class="row1 d-flex justify-content-center align-items-center">
                <div class="p-5">
                    <h1 class="">Restaurants at home</h1>
                    <h5>Get delicious meals delivered to your doorstep.</h5>
                </div>
            </div>

            <div class="row2 container">
                <h1 class="text-center m-5">How It Works</h1>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3>Choose a restaurant</h3>
                    </div>
                    <div>
                        <h3>Pick your meals</h3>
                    </div>
                    <div>
                        <h3>Fast delivery</h3>
                    </div>
                    <div>
                        <h3>Eat & Enjoy</h3>
                    </div>
                </div>
            </div>
        </section>

        <!-- Site footer -->
        @include('components.footer')

    </div>
</x-guest-layout>
