<x-intranet-layout>
    <x-slot name="header">
        <h1 class="h3 mb-0 text-gray-800">
            {{ __('Edit dish') }}
        </h1>
    </x-slot>

    <div class="row">

        <form method="POST" action="/intranet/dishes/{{ $dish->id }}" enctype="multipart/form-data"
            class="modal-content">
            @csrf
            @method('PUT')
            {{-- <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit dish</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> --}}
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" class="@error('name') is-invalid @enderror" name="name" id="name"
                        type="text" value="{{ $dish->name }}">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <input class="form-control" class="@error('category') is-invalid @enderror" name="category"
                        id="category" type="text" value="{{ $dish->category_id }}">
                    @error('category')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input class="form-control" class="@error('price') is-invalid @enderror" name="price" id="price"
                        type="text" value="{{ $dish->price }}">
                    @error('price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" cols="30" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label for="photo_path">Photo</label>
                    <input type="file" name="photo_path" id="photo_path" class="form-control">
                </div>
            </div>
            <div class=" modal-footer">
                <input type="hidden" name="restaurant_id" value="{{ $dish->restaurant_id }}">
                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>


    </div>

</x-intranet-layout>
