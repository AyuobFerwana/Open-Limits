@extends('ase.dashboard')

@section('title', 'Edit User')

@section('style')

@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Edit/</span> User</h4>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Edit User</h5>
                </div>
                <div class="card-body">
                    <form id="form" onsubmit="event.preventDefault(); updateUser(); ">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="Name Users">USER NAME</label>
                            <input type="text" class="form-control" id="UsersName" value="{{ $user->UsersName }}"
                                placeholder="Name User" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="email">E-MAIL</label>
                            <input type="email" class="form-control" id="email" value="{{ $user->email }}"
                                placeholder="email@example.com" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="Name Users">PHONE NUMBER</label>
                            <input type="number" class="form-control" id="phone" value="{{$user->phone}}"
                                placeholder="(+970) 59 *** ****" />
                        </div>


                        <div class="mb-3">
                            <label class="form-label" for="Image">Image</label>
                            <input class="form-control" name="img[]" type="file" id="image">

                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ url()->previous() }}" class="btn btn-dark">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script>
    function updateUser() {
        let formData = new FormData();
        formData.append('_method', 'PUT');
        formData.append('UsersName', document.getElementById('UsersName').value);
        formData.append('email', document.getElementById('email').value);
        formData.append('phone', document.getElementById('phone').value);

        if (document.getElementById('image').files.length > 0) {
            formData.append('image', document.getElementById('image').files[0]);
        }

        // Replace "user_id" with the actual user ID
        let userId = {{ $user->id }}

        axios.post('{{ route('users.update', ['user' => 'user_id']) }}'.replace('user_id', userId), formData)
            .then(function(response) {
                toastr.success(response.data.message);
                console.log(response);
                document.getElementById('form');
            })
            .catch(function(error) {
                toastr.error(error.response.data.message);
                console.log(error);
            });
    }
</script>

@endsection
