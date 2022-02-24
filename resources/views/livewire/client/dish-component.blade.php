<div>
    <h2 class="mb-4">Dishes</h2>

    @if (session('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @elseif($errors->any())
        <div class="alert alert-danger" role="alert">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="d-flex btn-group mb-2" class="" role="group">
        @foreach (App\Models\Category::getCategories($restaurant->id) as $category)
            <button wire:click="filter({{ $category->id }})" type="button"
                class="btn btn-dark flex-fill">{{ $category->name }}</button>
        @endforeach
    </div>

    <div>
        @if ($clearSearch)
            <button wire:click="filter" wire:model="clearSearch" type="button" class="btn btn-info mb-2">x</button>
        @endif
    </div>

    <div class="card-columns">
        @each('components.dish.dish-card', $dishes, 'dish')
    </div>
</div>
