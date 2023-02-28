@extends('ase.dashboard')

@section('title', 'Create Users')

@section('style')

@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Create/</span> Users</h4>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Create Users</h5>
                </div>
                <div class="card-body">
                    <form id="form" onsubmit="event.preventDefault(); PerformUser(); ">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="Name Users">USERS NAME</label>
                            <input type="text" class="form-control" id="UsersName" placeholder="Name Users" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="email">E-MAIL</label>
                            <input type="email" class="form-control" id="email" placeholder="email_34@example.com" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="Name Users">PHONE NUMBER</label>
                            <input type="number" class="form-control" id="phone" placeholder="220 155 198" />
                        </div>


                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>

                            <input type="password" id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password" />
                            <span class="input-group-text cursor-pointer"><i
                                    class="bx bx-hide"></i><strong></span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password_confirmation">Password-Confirmation</label>

                            <input type="password_confirmation" id="password_confirmation"
                                class="form-control  @error('password') is-invalid @enderror"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password" />
                            @error('password')
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            @enderror

                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="Image">Image</label>
                            <input class="form-control" name="img[]" type="file" id="image">

                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script>
    function PerformUser() {
            let formData = new FormData();
            formData.append('UsersName', document.getElementById('UsersName').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('phone', document.getElementById('phone').value);
            formData.append('password', document.getElementById('password').value);
            formData.append('password_confirmation', document.getElementById('password_confirmation').value);

            if (document.getElementById('image').files.length > 0) {
                formData.append('image', document.getElementById('image').files[0]);
            }
            axios.post('{{ route('users.store') }}', formData)
                .then(function(response) {
                    toastr.success(response.data.message);
                    console.log(response);
                    document.getElementById('form').reset();
                })
                .catch(function(error) {
                    toastr.error(error.response.data.message);
                    console.log(error);
                });
        }
</script>

@endsection