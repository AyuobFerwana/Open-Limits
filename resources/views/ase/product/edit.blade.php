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
                            <label for="Category" class="form-label">Select Category</label>
                            <select class="form-select" id="categoryName" aria-label="Default select example">
                                @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id }}" @selected($product->category->categoryName)>{{
                                    $categorie->categoryName }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="Name Store">Name Product</label>
                            <input type="text" class="form-control" value="{{ $product->productName }}" id="productName"
                                placeholder="Name Product" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="Discreption">Discreption</label>
                            <input type="text" class="form-control" value="{{ $product->discreption }}" id="discreption"
                                placeholder="Discreption" />
                        </div>
                        <div class="form-group">
                            <label for="color"> Color</label>

                            <div id="colors-container">
                                @foreach ($product->colors as $colors)
                                @if (!$loop->first)
                                <input type="color" value="{{ $colors }}" class="form-control"
                                    id="color_{{ $loop->iteration - 1 }}">
                                @endif

                                @endforeach
                            </div>

                            <button type="button" onclick="addColor()" class="btn btn-success">Add Color &plus;</button>
                            <button type="button" onclick="resetColors()" class="btn btn-danger"
                                style="margin-left: 20px;">Clear
                                Colors</button>
                        </div>


                        <div class="mb-3">
                            <label for="size">Size</label>

                            <div id="sizes-container">
                                @foreach ($product->size as $size)
                                @if (!$loop->first)
                                <input type="text" value="{{ $size }}" class="form-control"
                                    id="size_{{ $loop->iteration - 1 }}">
                                @endif
                                @endforeach
                            </div>


                            <button type="button" onclick="addSize()" class="btn btn-success">Add Sizes &plus;</button>
                            <button type="button" onclick="resetSizes()" class="btn btn-danger"
                                style="margin-left: 20px;">Clear Sizes</button>
                        </div>


                        <div class="mb-3">
                            <label for="Quantity" class="form-label">Quantity</label>
                            <div class="mb-3" style="width: 100%;">
                                <input type="number" value="{{ $product->quantity }}" class="form-control" id="quantity"
                                    placeholder="Quantity" min="0">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="Price">Price</label>
                            <input type="Number" id="price" class="form-control phone-mask"
                                value="{{ $product->price }}" placeholder="Price" min="0" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="discount">Discount</label>
                            <input type="Number" id="discount" value="{{ $product->discount }}"
                                class="form-control phone-mask" placeholder="Discount" />
                        </div>

                        <div class="col-md">
                            <label class="form-label" for="discount">Flag</label>
                            <div class="form-check mt-7">
                                <label class="form-check-label" for="Price"> Price </label>
                                <input class="form-check-input" id="selectedValue" type="radio" value="price"
                                    @checked(!$product->flag) /><br>
                                <label class="form-check-label" for="Discount"> Discount </label>
                                <input class="form-check-input" id="selectedValue" type="radio" value="discount"
                                    @checked(!$product->flag) />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="Image">Image</label>
                            <input class="form-control" value="{{ $product->image }}" name="img[]" type="file"
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
    let colors = 0;
        let sizes =1;

        
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



            // {{--  Size  --}}
            function addSize() {
              const sizeInput = document.createElement("input");
              sizeInput.setAttribute('type', 'text');
              sizeInput.setAttribute('class', 'form-control');
              sizeInput.setAttribute('id', `size_${++sizes}`);
              document.getElementById('sizes-container').appendChild(sizeInput);
          }
  
          function resetSizes() {
              const sizeInput = document.createElement("input");
              sizeInput.setAttribute('type', 'text');
              sizeInput.setAttribute('class', 'form-control');
              sizeInput.setAttribute('id', `size`);
              document.getElementById('sizes-container').innerHTML = '';  
              document.getElementById('sizes-container').appendChild(sizeInput);
              sizes = 0;
          }



    function PerformProduct() {
            let formData = new FormData();
            formData.append('_method', 'PUT');
            formData.append('categoryName', document.getElementById('categoryName').value);
            formData.append('productName', document.getElementById('productName').value);
            formData.append('discreption', document.getElementById('discreption').value);
            formData.append('price', document.getElementById('price').value);
            formData.append('discount', document.getElementById('discount').value);
            formData.append('color', document.getElementById('color').value);
             formData.append('quantity', document.getElementById('quantity').value);
            const radioButtons = document.querySelectorAll('input[type="radio"]');

            let selectedValue;
            radioButtons.forEach(radio => {
                if (radio.checked) {
                    selectedValue = radio.value;
                }
            });

             // {{--  Colors  --}}
            formData.append('colors', colors);
            for (let i = 1; i <= colors; i++) {
                formData.append('color_' + i, document.getElementById('color_' + i).value);
            }


               // {{--  Sizes  --}}
               formData.append('size', sizes);
               for (let i = 1; i <= sizes; i++) {
                   formData.append('size_' + i, document.getElementById('size_' + i).value);
               }

            formData.append('flag', selectedValue);

            if (document.getElementById('image').files.length > 0) {
                formData.append('image', document.getElementById('image').files[0]);
            }

            // {{--  axios  --}}

            axios.post('{{ route('products.update', $product) }}', formData)
                .then(function(response) {
                    toastr.success(response.data.message);
                    console.log(response);
                    document.getElementById('form').reset();
                   // {{--  window.location.href = 'dashboard/products/create';  --}}
                })
                .catch(function(error) {
                    toastr.error(error.response.data.message);
                    console.log(error);
                });
            }
            
       
</script>

@endsection