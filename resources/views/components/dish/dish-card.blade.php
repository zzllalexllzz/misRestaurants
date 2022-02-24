<div class="card">
    <img src="{{ Storage::disk('s3')->url($dish->photo_path) }}" class="card-img-top" alt="{{ $dish->name }}">
    <div class="card-body">
        <div class="d-flex">
            <a href="/dish/{{ $dish->id }}">
                <h5 class="card-title pr-2">{{ $dish->name }}</h5>
            </a>
            <span>{{ $dish->price }} &euro;</span>
        </div>
    </div>

    <div class="card-footer bg-white">
        @can('create', App\Models\Order::class)
            <a href="/cart/add/{{ $dish->id }}" class="btn p-0 text-success font-bold"><b>Add to cart</b></a>
        @else
            <a href="#" class="btn p-0 text-success font-bold" disabled title="Disabled for intranet users">
                <b>Add to cart</b></a>
        @endcan
    </div>

</div>
