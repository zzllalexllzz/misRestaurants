<div>
    <div class="d-flex flex-row my-3 justify-content-between align-items-center">
        <div class="col-lg-4 col-md-10 col-sm-12 p-0">
            <x-input.text wire:model="search" placeholder="Search categories..." name="search-category" />
        </div>
        <div>
            <a wire:click="create" href="#" data-toggle="modal" data-target="#openModal" class="btn btn-primary">
                <i class="fas fa-plus"></i> New</a>
        </div>
    </div>

    <ul class="column-counted">
        @foreach ($categories as $category)
            <div class="group-links d-flex flex-row align-items-center">
                @can('update', $category)
                    <a wire:click="edit({{ $category->id }})" href="#" data-toggle="modal" data-target="#openModal"
                        class="hidden-btn hidden-edit btn open-edit-modal"><i class="fas fa-edit"></i>
                    </a>
                    <a wire:click="deleteId({{ $category->id }})" href="#" data-toggle="modal"
                        data-target="#openDeleteModal" class="hidden-btn hidden-delete btn"><i class="fas fa-trash-alt"></i>
                    </a>
                @endcan
                <li>{{ $category->name }}</li>
            </div>
        @endforeach
    </ul>

    <!-- Create / Update Category Modal -->
    <form>
        <x-modal.dialog wire:ignore.self id="openModal">
            <x-slot name="title">{{ $modalTitle }}</x-slot>
            <x-slot name="content">
                <x-input.group label="Name" for="name" :error="$errors->first('editing.name')">
                    <x-input.text wire:model="editing.name" name="name" />
                </x-input.group>
            </x-slot>
            <x-slot name="footer">
                <x-button.secondary data-dismiss="modal">Cancel</x-button.secondary>
                <x-button.primary wire:click.prevent="save()" class="submitModal">Save</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>

    <!-- Delete Category Modal -->
    <form>
        <x-modal.confirmation wire:ignore.self id="openDeleteModal">
            <x-slot name="title">Delete Category</x-slot>
            <x-slot name="content">
                <div class="d-flex justify-content-between align-items-center py-4">
                    <img src="{{ asset('storage/icons/error.svg') }}" style="max-width:100px;" class="m-3">
                    <h4 class="m-3">Are you sure? This action is irreversible.</h4>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-button.secondary data-dismiss="modal">Cancel</x-button.secondary>
                <x-button.primary wire:click.prevent="delete()" data-dismiss="modal">Delete</x-button.primary>
            </x-slot>
        </x-modal.confirmation>
    </form>
</div>
