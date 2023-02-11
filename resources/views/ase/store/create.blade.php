@extends('ase.dashboard')

@section('title', 'Create Store')

@section('style')

@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Create/</span> Store</h4>

        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Create Store</h5>
                    </div>
                    <div class="card-body">
                        <form id="form" onsubmit="event.preventDefault(); PerformStore(); ">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="Name Store">Name Store</label>
                                <input type="text" class="form-control" id="name"placeholder="Name Store" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="Address">Address</label>
                                <input type="text" class="form-control" id="address" placeholder="address" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="Email">Email</label>
                                <div class="input-group input-group-merge">
                                    <input type="email" id="email" class="form-control" placeholder="@example.com"
                                        aria-label="@example.com" aria-describedby="basic-default-email2" />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="Phone">Phone No</label>
                                    <input type="Number" id="phone" class="form-control phone-mask"
                                        placeholder="658 799 8941" />
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
        function PerformStore() {
            let formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('address', document.getElementById('address').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('phone', document.getElementById('phone').value);
            if (document.getElementById('image').files.length > 0) {
                formData.append('image', document.getElementById('image').files[0]);
            }
            axios.post('{{ route('store.store') }}', formData)
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
