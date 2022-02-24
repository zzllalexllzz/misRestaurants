 <div class="">

     <div class="d-flex flex-row my-3 justify-content-between align-items-center">
         <div class="col-lg-4 col-md-10 col-sm-12 p-0">
             <x-input.text wire:model="search" placeholder="Search restaurants by name or city..."
                 name="search-restaurant" />
         </div>
         @can('create', \App\Models\Restaurant::class)
             <div>
                 <a wire:click="create" href="#" data-toggle="modal" data-target="#openModal" class="btn btn-primary"><i
                         class="fas fa-plus"></i> New</a>
             </div>
         @endcan
     </div>

     <x-table.table>
         <x-slot name="head">
             <x-table.heading sortable wire:click="sortBy('name')"
                 :direction="$sortField === 'name' ? $sortDirection : null" class="w-25">Name</x-table.heading>
             <x-table.heading sortable wire:click="sortBy('address')"
                 :direction="$sortField === 'address' ? $sortDirection : null">Address</x-table.heading>
             <x-table.heading sortable wire:click="sortBy('city')"
                 :direction="$sortField === 'city' ? $sortDirection : null">City</x-table.heading>
             <x-table.heading sortable wire:click="sortBy('phone')"
                 :direction="$sortField === 'phone' ? $sortDirection : null">Phone</x-table.heading>
             <x-table.heading sortable wire:click="sortBy('email')"
                 :direction="$sortField === 'email' ? $sortDirection : null">Email</x-table.heading>
             <x-table.heading>Actions</x-table.heading>
         </x-slot>
         <x-slot name="body">
             @forelse ($restaurants as $restaurant)
                 <x-table.row>
                     <x-table.cell>{{ $restaurant->name }}</x-table.cell>
                     <x-table.cell>{{ $restaurant->address }}</x-table.cell>
                     <x-table.cell>{{ $restaurant->city }}</x-table.cell>
                     <x-table.cell>{{ $restaurant->phone }}</x-table.cell>
                     <x-table.cell>{{ $restaurant->email }}</x-table.cell>
                     <x-table.cell>

                         <a href="/intranet/restaurants/{{ $restaurant->id }}" title="Details" class="pl-1"><i
                                 class="fas fa-eye"></i></a>
                         <a href="/intranet/dishes/{{ $restaurant->id }}" title="Menu" class="p-1"><i
                                 class="fas fa-clipboard-list"></i></a>
                         <a href="/intranet/orders/{{ $restaurant->id }}" title="Orders" class="p-1"><i
                                 class="fas fa-cart-arrow-down"></i></a>
                         <a wire:click="edit({{ $restaurant->id }})" href="#" data-toggle="modal" data-target="#openModal"
                             class="p-1" title="Edit"><i class="fas fa-edit"></i></a>
                         <a wire:click="deleteId({{ $restaurant->id }})" href="#" data-toggle="modal"
                             data-target="#openDeleteModal" class="p-1" title="Delete"><i class="fas fa-trash-alt"></i></a>
                     </x-table.cell>
                 </x-table.row>

             @empty
                 <tr>
                     <td colspan="6">No restaurants found.</td>
                 </tr>
             @endforelse
         </x-slot>
     </x-table.table>

     <div class="mx-2">{{ $restaurants->links() }}</div>

     <!-- Create / Update Restaurant Modal -->
     <form>
         <x-modal.dialog wire:ignore.self id="openModal">
             <x-slot name="title">{{ $modalTitle }}</x-slot>
             <x-slot name="content">

                 <x-input.group label="Name" for="name" :error="$errors->first('editing.name')">
                     <x-input.text wire:model="editing.name" name="name" />
                 </x-input.group>

                 <div class="form-row">
                     <x-input.group class="col-md-7" label="Address" for="address"
                         :error="$errors->first('editing.address')">
                         <x-input.text wire:model="editing.address" name="address" />
                     </x-input.group>
                     <x-input.group class="col-md-5" label="City" for="city" :error="$errors->first('editing.city')">
                         <x-input.text wire:model="editing.city" name="city" />
                     </x-input.group>
                 </div>

                 <div class="form-row">
                     <x-input.group class="col-md-5" label="Phone" for="phone" :error="$errors->first('editing.phone')">
                         <x-input.text wire:model="editing.phone" name="phone" />
                     </x-input.group>
                     <x-input.group class="col-md-7" label="Email" for="email" :error="$errors->first('editing.email')">
                         <x-input.email wire:model="editing.email" name="email" />
                     </x-input.group>
                 </div>

                 <div class="form-row">
                     <x-input.group class="col-md-6" label="Latitude" for="latitude"
                         :error="$errors->first('editing.latitude')">
                         <x-input.text wire:model="editing.latitude" name="latitude" />
                     </x-input.group>
                     <x-input.group class="col-md-6" label="Longitude" for="longitude"
                         :error="$errors->first('editing.longitude')">
                         <x-input.text wire:model="editing.longitude" name="longitude" />
                     </x-input.group>
                 </div>

                 <x-input.group label="Photo" for="photo_path" :error="$errors->first('upload')">
                     <x-input.file name="photo_path" wire:model="upload" />
                 </x-input.group>

             </x-slot>
             <x-slot name="footer">
                 <x-button.secondary data-dismiss="modal">Cancel</x-button.secondary>
                 <x-button.primary wire:click.prevent="save()" id="submitModal">Save</x-button.primary>
             </x-slot>

         </x-modal.dialog>
     </form>


     <!-- Delete Restaurant Modal -->
     <form>
         <x-modal.confirmation wire:ignore.self id="openDeleteModal">
             <x-slot name="title">Delete Restaurant</x-slot>
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
