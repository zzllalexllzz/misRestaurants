<ul class="navbar-nav mr-auto">
    @if (Auth::user()->role->name != 'Client')
        <x-jet-nav-link href="{{ route('intranet') }}" :active="request()->routeIs('intranet')">
            {{ __('Intranet') }}
        </x-jet-nav-link>
    @endif
    <x-jet-nav-link href="{{ route('main') }}" :active="request()->routeIs('main')">
        {{ __('Home') }}
    </x-jet-nav-link>
    <x-jet-nav-link href="{{ route('restaurants') }}" :active="request()->routeIs('restaurants')">
        {{ __('Restaurants') }}
    </x-jet-nav-link>
    <x-jet-nav-link href="{{ route('categories') }}" :active="request()->routeIs('categories')">
        {{ __('Categories') }}
    </x-jet-nav-link>

</ul>
