@extends('ase.dashboard')

@section('title', 'Index Users')

@section('style')

@endsection

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Index /</span> Users</h4>

    <div class="card">
        <h5 class="card-header">Index Users</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Logo</th>
                        <th>UserName</th>
                        <th>E-mail</th>
                        <th>Type-User</th>

                        <th>Phone</th>
                        <th>Create_At</th>
                        <th>Updated_at</th>
                        <th>Setting</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($users->skip(2) as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ Storage::url($user->image) }}" alt="image" width="60"
                                style="border-radius: 10px;">
                        </td>
                        <td>{{ $user->UsersName }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if (auth()->user()->id == $user->id)
                            <button type="button" style="cursor: not-allowed"
                                class="btn btn-{{ $user->role == 'admin' ? 'primary' : 'success' }} mr-2" disabled>
                                {{ $user->role }}
                            </button>
                            @else
                            <button type="button" onclick="toggleRole({{ $user->id }}, this)"
                                class="btn btn-{{ $user->role == 'admin' ? 'primary' : 'success' }} mr-2">
                                {{ $user->role }}
                            </button>
                            @endif
                        </td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>

                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    {{-- <a class="dropdown-item" href="{{ route('users.edit', $user->id) }}"><i
                                            class="bx bx-edit-alt me-2"></i> Edit</a> --}}
                                    <a class="dropdown-item" onclick="performDestroy('{{ $user->id }}',this)"><i
                                            class="bx bx-trash me-2"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    function performDestroy(id, reference) {
            confirmDestroy('/dashboard/users', id, reference)
        }

        // ToggleRole
        function toggleRole(id, ref) {
            ref.disabled = true;
            axios.put(`/dashboard/users/${id}/toggle`)
                .then((response) => {
                    toastr.success(response.data.message);
                    ref.innerHTML = response.data.role;
                    if (response.data.role == 'admin') {
                        ref.setAttribute('class', 'btn btn-primary mr-2');
                    } else {
                        ref.setAttribute('class', 'btn btn-success mr-2');
                    }
                }).catch((error) => {
                    toastr.success(error.response.data.message);
                }).finally(() => {
                    ref.disabled = false;
                });
        }
</script>


@endsection
