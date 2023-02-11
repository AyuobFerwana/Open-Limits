@extends('ase.dashboard')

@section('title', 'Restore')

@section('style')

@endsection

@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Restore /</span> Store</h4>

        <div class="card">
            <h5 class="card-header">Restore Store</h5>
            <div>
                <a href="{{ route('store.index') }}" class="btn btn-info" style="width: 150px">View All Users</a>
                <a href="{{ route('store.restore.all') }}" class="btn btn-success" style="width: 150px">Restore All</a>
            </div>
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
                                    <a href="{{ route('store.resto', $store->id) }}"class="btn btn-primary">Restore</a>
                                    <a onclick="performDestroy('{{ $store->id }}',this)"class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{ $stores->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        function performDestroy(id, reference) {
            confirmDestroy('/dashboard/RestoreStoreDestroy', id, reference)
        }
    </script>

    <script type="text/javascript">
        $('.show_confirm').click(function(e) {
            if (!confirm('Are you sure you want to delete this?')) {
                e.preventDefault();
            }
        });
    </script>


@endsection
