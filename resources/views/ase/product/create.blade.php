@extends('ase.dashboard')

@section('title', 'Create Product')

@section('style')

@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Create/</span> Product</h4>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Create Product</h5>
                </div>
                <div class="card-body">
                    <form id="form" onsubmit="event.preventDefault(); PerformProduct(); ">
                        @csrf
                        <div class="mb-3">
                            <label for="Store" class="form-label">Select Store</label>
                            <select class="form-select" id="store" aria-label="Default select example">
                                @foreach ($stores as $store)
                                <option value="{{ $store->id }}">{{ $store->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="Name Store">Name Product</label>
                            <input type="text" class="form-control" id="productName" placeholder="Name Product" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="Discreption">Discreption</label>
                            <input type="text" class="form-control" id="discreption" placeholder="Discreption" />
                        </div>

                        <div class="form-group">
                            <label for="color"> Color</label>
                            <div id="colors-container">
                                <input type="color" value="#000000" class="form-control" id="color">
                            </div>
                            <button type="button" onclick="addColor()" class="btn btn-success">Add Color &plus;</button>
                            <button type="button" onclick="resetColors()" class="btn btn-danger"
                                style="margin-left: 20px;">Clear
                                Colors</button>
                        </div>

                        <div class="mb-3">
                            <label for="size">Size</label>
                            <input type="text" class="form-control" id="sizes">
                        </div>

                        <div class="mb-3">
                            <label for="Quantity" class="form-label">Quantity</label>
                            <div class="mb-3" style="width: 100%;">
                                <input type="number" class="form-control" id="quantity" placeholder="Quantity" min="0">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="Price">Price</label>
                            <input type="Number" id="price" class="form-control phone-mask" placeholder="Price"
                                min="0" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="discount">Discount</label>
                            <input type="Number" id="discount" class="form-control phone-mask" placeholder="Discount" />
                        </div>

                        <div class="col-md">
                            <label class="form-label" for="discount">Flag</label>
                            <div class="form-check mt-7">
                                <label class="form-check-label" for="Price"> Price </label>
                                <input class="form-check-input" id="selectedValue" type="radio" value="price" /><br>
                                <label class="form-check-label" for="Discount"> Discount </label>
                                <input class="form-check-input" id="selectedValue" type="radio" value="discount" />
                            </div>
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
    let colors = 0;

        function PerformProduct() {
            let formData = new FormData();
            formData.append('store', document.getElementById('store').value);
            formData.append('productName', document.getElementById('productName').value);
            formData.append('discreption', document.getElementById('discreption').value);
            formData.append('price', document.getElementById('price').value);
            formData.append('discount', document.getElementById('discount').value);
            formData.append('color', document.getElementById('color').value);
            formData.append('sizes', getSelectSizes());
            formData.append('quantity', getQuantity());

            // {{--  Flag  --}}
            const radioButtons = document.querySelectorAll('input[type="radio"]');
            let selectedValue;
            radioButtons.forEach(radio => {
                if (radio.checked) {
                    selectedValue = radio.value;
                }
            });
            formData.append('flag', selectedValue);

            // {{--  Image  --}}
            if (document.getElementById('image').files.length > 0) {
                formData.append('image', document.getElementById('image').files[0]);
            }

            // {{--  Colors  --}}
            formData.append('colors', colors);
            for (let i = 1; i <= colors; i++) {
                formData.append('color_' + i, document.getElementById('color_' + i).value);
            }

            // {{--  Quantity  --}}
            let products = [{
                id: 1,
                name: 'Product 1',
                quantity: 10
            }, {
                id: 2,
                name: 'Product 2',
                quantity: 20
            }, {
                id: 3,
                name: 'Product 3',
                quantity: 30
            }];

            function getQuantity() {
                let input = document.getElementById('quantity');
                let decrementProductQuantity = (productId, quantity) => {
                    let Product = products.find(Product => Product.id === productId);
                    Product.quantity -= quantity;
                };

                let order = {
                    quantity: 5
                };

                decrementProductQuantity(1, order.quantity);
                console.log(products[0].quantity);
            }


            // {{--  axios  --}}
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

        // {{--  Colors  --}}
        function addColor() {
            const colorInput = document.createElement("input");
            colorInput.setAttribute('type', 'color');
            colorInput.setAttribute('value', '#000000');
            colorInput.setAttribute('class', 'form-control');
            colorInput.setAttribute('id', `color_${++colors}`);
            document.getElementById('colors-container').appendChild(colorInput);
        }

        function resetColors() {
            const colorInput = document.createElement("input");
            colorInput.setAttribute('type', 'color');
            colorInput.setAttribute('value', '#000000');
            colorInput.setAttribute('class', 'form-control');
            colorInput.setAttribute('id', `color`);
            document.getElementById('colors-container').innerHTML = '';
            document.getElementById('colors-container').appendChild(colorInput);
            colors = 0;
        }


        function getSelectSizes() {
            let select = document.getElementById('sizes');
            var result = [];
            var options = select && select.options;
            var opt;

            for (var i = 0, iLen = options.length; i < iLen; i++) {
                opt = options[i];

                if (opt.selected) {
                    result.push(opt.value || opt.text);
                }
            }
            return result;
        }
</script>

@endsection