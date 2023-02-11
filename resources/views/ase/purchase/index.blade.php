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
                        <th>Store</th>
                        <th>Product Name</th>
                        <th>Discreption</th>
                        <th>Purchase</th>
                        <th>Flag</th>
                        <th>Created_at</th>
                        <th>Setting</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($purchases as $purchase)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="align-middle white-space-nowrap py-0">
                            <img src="{{ Storage::url($product->product->image) }}" alt="Product-image" width="53"
                                style="border-radius: 10px;">
                        </td>
                        <td>{{ $purchase->product->store->name }}</td>
                        <td>{{ $purchase->product->productName }}</td>
                        {{-- <td>{{ $purchase->product->discreption }}</td>
                        <td>{{ $purchase->product->price }}</td> --}}
                        <td>{{ $purchase->product->flag == 'price' ? $purchase->product->price :
                            $purchase->product->discount }}

                        <td>{{ $purchase->product->discount }}</td>
                        <td>
                            @if ($purchase->flag)
                            <h6 style="color:#ff0000"> Discount</h6>
                            @else
                            <h6 style="color:rgb(43, 255, 0)"> Price</h6>
                            @endif
                        </td>
                        <td>{{ $purchase->created_at }}</td>
                       

                        <td>
                            <div class="btn-group">
                                <button type="button" onclick="performDestroy('{{ $purchase->product->id }}',this)"
                                    class="btn btn-square btn-outline-danger m-0.1 border-rad">
                                    <i class="fas fa-trash"></i>
                                </button>
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
            confirmDestroy('/dashboard/purchase', id, reference)
        }
</script>


@endsection