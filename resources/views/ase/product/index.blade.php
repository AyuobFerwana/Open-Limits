@extends('ase.dashboard')

@section('title', 'Index Product')

@section('style')

@endsection

@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Index /</span> Product</h4>

        <div class="card">
            <h5 class="card-header">Index Product</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Logo</th>
                            <th>Store</th>
                            <th>Product Name</th>
                            <th>Discreption</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Flag</th>
                            <th>Created_at</th>
                            <th>Updated_at</th>
                            <th>Setting</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="align-middle white-space-nowrap py-0">
                                    <img src="{{ Storage::url($product->image) }}" alt="Product-image" width="53"
                                        style="border-radius: 10px;">
                                </td>
                                <td>{{ $product->store->name }}</td>
                                <td>{{ $product->productName }}</td>
                                <td>{{ $product->discreption }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->discount }}</td>
                                <td>
                                    @if ($product->flag)
                                        <h6 style="color:#696CFF"> Discount</h6>
                                    @else
                                        <h6 style="color:rgb(255, 0, 0)"> Price</h6>
                                    @endif
                                </td>
                                <td>{{ $product->created_at }}</td>
                                <td>{{ $product->updated_at }}</td>
                                <td>{{$product->purchases->count()}}</td>

                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('products.edit', $product->id) }}"><i
                                                    class="bx bx-edit-alt me-2"></i> Edit</a>
                                            <a class="dropdown-item"
                                                onclick="performDestroy('{{ $product->id }}',this)"><i
                                                    class="bx bx-trash me-2"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
            </div>
            </tr>
            @endforeach
            </tbody>
            </table>
        </div>
    </div>
@endsection


@section('script')
    <script>
        function performDestroy(id, reference) {
            confirmDestroy('/dashboard/products', id, reference)
        }
    </script>


@endsection