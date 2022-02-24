<x-intranet-layout>

    <div class="row">

        <div class="card" style="width: 35rem;">
            <div class="card-header">
                <h5 class="card-title">Restaurant details</h5>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            @isset($restaurant->photo_path)
                                <tr>
                                    <td colspan="2">
                                        <img src="{{ Storage::disk('s3')->url($restaurant->photo_path) }}"
                                            alt="{{ $restaurant->name }}" class="card-img-top h-45" />
                                    </td>
                                </tr>
                            @endisset

                            <tr>
                                <th>Name</th>
                                <td>{{ $restaurant->name }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $restaurant->address }}</td>
                            </tr>
                            <tr>
                                <th>City</th>
                                <td>{{ $restaurant->city }}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ $restaurant->phone }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $restaurant->email }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</x-intranet-layout>
