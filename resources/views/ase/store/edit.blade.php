@extends('ase.dashboard')

@section('title', 'Edit Store')

@section('style')

@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Edit/</span> Store</h4>

        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Store</h5>
                    </div>
                    <div class="card-body">
                        <form id="form" onsubmit="event.preventDefault(); editStore(); ">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="Name Store">Name Store</label>
                                <input type="text" class="form-control" value="{{ $store->name }}"
                                    id="name"placeholder="Name Store" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="Address">Address</label>
                                <input type="text" class="form-control" value="{{ $store->address }}" id="address"
                                    placeholder="address" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="Email">Email</label>
                                <div class="input-group input-group-merge">
                                    <input type="email" id="email" class="form-control" value="{{ $store->email }}"
                                        placeholder="@example.com" aria-label="@example.com"
                                        aria-describedby="basic-default-email2" />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="Phone">Phone No</label>
                                    <input type="Number" value="{{ $store->phone }}" id="phone"
                                        class="form-control phone-mask" placeholder="658 799 8941" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="Image">Image</label>
                                    <input class="form-control" value="{{ $store->image }}" name="img[]" type="file"
                                        id="image">

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
        function editStore() {
            let formData = new FormData();
            formData.append('_method', 'PUT');
            formData.append('name', document.getElementById('name').value);
            formData.append('address', document.getElementById('address').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('phone', document.getElementById('phone').value);
            if (document.getElementById('image').files.length > 0) {
                formData.append('image', document.getElementById('image').files[0]);
            }
            axios.post('{{ route('store.update', $store) }}', formData)
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
