@extends('ase.dashboard')

@section('title', 'Restore')

@section('style')

@endsection

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Restore /</span> users</h4>

    <div class="card">
        <h5 class="card-header">Restore users</h5>
        <div>
            <a href="{{ route('users.index') }}" class="btn btn-info" style="width: 150px">View All Users</a>
            <a href="{{ route('users.Restore.all') }}" class="btn btn-success" style="width: 150px">Restore All</a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Logo</th>
                        <th>User Name</th>
                        <th>E-mail</th>
                        <th>Phone</th>
                        <th>Deleted_at</th>
                        <th>Setting</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td class="align-middle white-space-nowrap py-0">
                            <img src="{{ Storage::url($user->image) }}" alt="Product-image" width="60"
                                style="border-radius: 10px;">
                        </td>
                        <td>{{ $user->UsersName }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->deleted_at }}</td>
                        <td>
                            <a href="{{ route('users.restore', $user->id) }}" style="color:aliceblue"
                                class="btn btn-primary">Restore</a>
                            <a onclick="performDestroy('{{ $user->id }}',this)" style="color:aliceblue"
                                class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    function performDestroy(id, reference) {
            confirmDestroy('/dashboard/RestoreUserdestroy', id, reference)
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