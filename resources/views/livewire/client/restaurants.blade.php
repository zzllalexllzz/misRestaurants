<div>

    <div class="col-lg-4 col-md-10 col-sm-12 p-0 mb-5">
        <x-input.text wire:model="search" placeholder="Write a name or city..." name="search-restaurant" />
    </div>


    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-3">
        @foreach ($restaurants as $restaurant)
            <div class="col mb-4">
                <div class="card">

                    <img src=" @if ($restaurant->photo_path) {{ Storage::disk('s3')->url($restaurant->photo_path) }}
                @else {{ Storage::disk('s3')->url('restaurants/default.png') }} @endif"
                    alt="{{ $restaurant->name }}" class="card-img-top" style="height: 14rem;" />

                    <div class="card-body">
                        <a href="/restaurant/{{ $restaurant->id }}">
                            <h5 class="card-title">{{ $restaurant->name }}</h5>
                        </a>
                        <small class="text-muted">{{ $restaurant->address }} | {{ $restaurant->city }}</small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
