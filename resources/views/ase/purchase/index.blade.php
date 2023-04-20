@extends('ase.dashboard')

@section('title', 'Purchase Transactions')

@section('style')

@endsection

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Purchase /</span> Transactions </h4>

    <div class="card">
        <h5 class="card-header"> Purchase Transactions </h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Logo</th>
                        <th>Product</th>
                        <th>Quntity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($checkouts as $checkout)
                    @foreach ($checkout->products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td class="align-middle white-space-nowrap py-0">
                            <img src="{{ Storage::url($product->product->image) }}" alt="Product-image" width="53"
                                style="border-radius: 10px;">
                        </td>

                        <td>{{ $product->product->productName }}</td>

                        <td>{{ $product->product->quntity }}</td>

                        <td> {{ !$product->product->flag ? $product->product->price : $product->product->discount }}
                        </td>

                        <td>
                            <div class="btn-group">
                                <button type="button" onclick="performDestroy('{{ $checkout->product->id }}',this)"
                                    class="btn btn-square btn-outline-danger m-0.1 border-rad">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </div>
                </tr>
                @endforeach
                <td>{{ $total }}</td>
        </tbody>
        </table>
    </div>
</div>
@endsection


@section('script')
<script>
    function performDestroy(id, reference) {
            confirmDestroy('/dashboard/purchase', id, reference)
        }
</script>


@endsection