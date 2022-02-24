<ul class="navbar-nav ml-auto align-items-baseline">
    <!-- Teams Dropdown -->
    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
        <x-jet-dropdown id="teamManagementDropdown">
            <x-slot name="trigger">
                {{ Auth::user()->currentTeam->name }}

                <svg class="ml-2" width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </x-slot>

            <x-slot name="content">
                <!-- Team Management -->
                <h6 class="dropdown-header">
                    {{ __('Manage Team') }}
                </h6>

                <!-- Team Settings -->
                <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                    {{ __('Team Settings') }}
                </x-jet-dropdown-link>

                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                    <x-jet-dropdown-link href="{{ route('teams.create') }}">
                        {{ __('Create New Team') }}
                    </x-jet-dropdown-link>
                @endcan

                <hr class="dropdown-divider">

                <!-- Team Switcher -->
                <h6 class="dropdown-header">
                    {{ __('Switch Teams') }}
                </h6>

                @foreach (Auth::user()->allTeams() as $team)
                    <x-jet-switchable-team :team="$team" />
                @endforeach
            </x-slot>
        </x-jet-dropdown>
    @endif


    <!-- Settings Dropdown -->
    @auth
        <!-- Cart Checkout -->
        @can('create', App\Models\Order::class)
            <li class="nav-item d-flex align-items-baseline">
                <a href="{{ route('checkout') }}" class="mx-2 text-info">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket-fill"
                        viewBox="0 0 16 16">
                        <path
                            d="M5.071 1.243a.5.5 0 0 1 .858.514L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 6h1.717L5.07 1.243zM3.5 10.5a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3z" />
                    </svg>
                </a>
                <div>
                    <span><small
                            class="border-info border-left border-right rounded-circle p-1">{{ Cart::count() }}</small></span>
                </div>
            </li>
        @endcan

        <x-jet-dropdown id="settingsDropdown">
            <x-slot name="trigger">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <img class="rounded-circle" width="32" height="32" src="{{ Auth::user()->profile_photo_url }}"
                        alt="{{ Auth::user()->name }}" />
                @else
                    {{ Auth::user()->name }}
                @endif
            </x-slot>

            <x-slot name="content">
                <!-- Account Management -->
                <h6 class="dropdown-header small text-muted">
                    {{ __('Manage Account') }}
                </h6>

                <x-jet-dropdown-link href="{{ route('profile.show') }}">
                    {{ __('Profile') }}
                </x-jet-dropdown-link>

                @can('create', App\Models\Order::class)
                    <x-jet-dropdown-link href="{{ route('orders') }}">
                        {{ __('Orders') }}
                    </x-jet-dropdown-link>
                @endcan

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                        {{ __('API Tokens') }}
                    </x-jet-dropdown-link>
                @endif

                <hr class="dropdown-divider">

                <!-- Authentication -->
                <x-jet-dropdown-link href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </x-jet-dropdown-link>
                <form method="POST" id="logout-form" action="{{ route('logout') }}">
                    @csrf
                </form>
            </x-slot>
        </x-jet-dropdown>
    @endauth
</ul>
