<x-app-layout>

    <div>
        <h2 class="mb-5">{{ $category->name }}</h2>

        @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @elseif($errors->any())
            <div class="alert alert-danger" role="alert">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="card-columns">
            @each('components.dish.dish-card', $dishes, 'dish')
        </div>


    </div>

</x-app-layout>
