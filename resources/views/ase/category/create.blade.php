@extends('ase.dashboard')

@section('title', 'Create Category')

@section('style')

@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Create/</span> Categories</h4>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Create Categories</h5>
                </div>
                <div class="card-body">
                    <form id="form" onsubmit="event.preventDefault(); PerformCategory(); ">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="Name Category">Name Category</label>
                            <input type="text" class="form-control" id="categoryName" placeholder="Name Category" />
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
    function PerformCategory() {
            let formData = new FormData();
            formData.append('categoryName', document.getElementById('categoryName').value);
            if (document.getElementById('image').files.length > 0) {
                formData.append('image', document.getElementById('image').files[0]);
            }
            axios.post('{{ route('category.store') }}', formData)
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