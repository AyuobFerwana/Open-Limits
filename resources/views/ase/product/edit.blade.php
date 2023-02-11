@extends('ase.dashboard')

@section('title', 'Edit Product')

@section('style')

@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Edit/</span> Product</h4>

        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Product</h5>
                    </div>
                    <div class="card-body">
                        <form id="form" onsubmit="event.preventDefault(); PerformProduct(); ">
                            @csrf
                            <div class="mb-3">
                                <label for="Store" class="form-label">Select Store</label>
                                <select class="form-select" id="store" aria-label="Default select example">
                                    @foreach ($stores as $store)
                                        <option value="{{ $store->id }}" @selected($products->store->name)>{{ $store->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="Name Store">Name Product</label>
                                <input type="text" class="form-control" value="{{ $products->productName }}"
                                    id="productName"placeholder="Name Product" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="Discreption">Discreption</label>
                                <input type="text" class="form-control" value="{{ $products->discreption }}"
                                    id="discreption" placeholder="Discreption" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="Price">Price</label>
                                <input type="Number" id="price" class="form-control phone-mask"
                                    value="{{ $products->price }}" placeholder="Price" min="0" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="discount">Discount</label>
                                <input type="Number" id="discount" value="{{ $products->discount }}"
                                    class="form-control phone-mask" placeholder="Discount" />
                            </div>

                            <div class="col-md">
                                <label class="form-label" for="discount">Flag</label>
                                <div class="form-check mt-7">
                                    <label class="form-check-label" for="Price"> Price </label>
                                    <input class="form-check-input" id="selectedValue" type="radio" value="price"
                                        @checked(!$products->flag) /><br>
                                    <label class="form-check-label" for="Discount"> Discount </label>
                                    <input class="form-check-input" id="selectedValue" type="radio" value="discount"
                                        @checked($products->flag) />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="Image">Image</label>
                                <input class="form-control" value="{{ $products->image }}" name="img[]" type="file"
                                    id="image">

                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
        function PerformProduct() {
            let formData = new FormData();
            formData.append('_method', 'PUT');
            formData.append('store', document.getElementById('store').value);
            formData.append('productName', document.getElementById('productName').value);
            formData.append('discreption', document.getElementById('discreption').value);
            formData.append('price', document.getElementById('price').value);
            formData.append('discount', document.getElementById('discount').value);

            const radioButtons = document.querySelectorAll('input[type="radio"]');
            let selectedValue;
            radioButtons.forEach(radio => {
                if (radio.checked) {
                    selectedValue = radio.value;
                }
            });

            formData.append('flag', selectedValue);

            if (document.getElementById('image').files.length > 0) {
                formData.append('image', document.getElementById('image').files[0]);
            }
            axios.post('{{ route('products.store') }}', formData)
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
