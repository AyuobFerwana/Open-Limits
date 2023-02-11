@extends('ase.dashboard')

@section('title', 'Index Store')

@section('style')

@endsection

@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Index /</span> Store</h4>

        <div class="card">
            <h5 class="card-header">Index Store</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Logo</th>
                            <th>Store Name</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Create_At</th>
                            <th>Updated_at</th>
                            <th>Setting</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($stores as $store)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="align-middle white-space-nowrap py-0">
                                    <img src="{{ Storage::url($store->image) }}" alt="Product-image" width="53"
                                        style="border-radius: 10px;">
                                </td>
                                <td>{{ $store->name }}</td>
                                <td>{{ $store->address }}</td>
                                <td>{{ $store->email }}</td>
                                <td>{{ $store->phone }}</td>
                                <td>{{ $store->created_at }}</td>
                                <td>{{ $store->updated_at }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('store.edit', $store->id) }}"><i
                                                    class="bx bx-edit-alt me-2"></i> Edit</a>
                                            <a class="dropdown-item" onclick="performDestroy('{{ $store->id }}',this)"><i
                                                    class="bx bx-trash me-2"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
            </div>
            </tr>
            @endforeach
            </tbody>
            </table>
        </div>
    </div>
@endsection


@section('script')
    <script>
        function performDestroy(id, reference) {
            confirmDestroy('/dashboard/store', id, reference)
        }
    </script>


@endsection
