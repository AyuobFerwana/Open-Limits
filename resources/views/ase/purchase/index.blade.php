@extends('ase.dashboard')

@section('title', 'Purchase Transactions')

@section('style')

@endsection

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Purchase /</span> Transactions </h4>

    @foreach ($checkouts as $checkout)
    <div class="card mb-5">
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
                        <th>Setting</th>

                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($checkout->products as $checkoutDatas)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td class="align-middle white-space-nowrap py-0">
                            <img src="{{ Storage::url($checkoutDatas->image) }}" alt="Product-image" width="100"
                                height="90" style="border-radius: 10px;">
                        </td>

                        <td>{{ $checkoutDatas->productName }}</td>

                        <td>{{ $checkoutDatas->pivot->quantity }}</td>

                        <td> {{ !$checkoutDatas->flag ? $checkoutDatas->price : $checkoutDatas->discount }}
                        </td>

                        <td>
                            <div class="btn-group">
                                <a onclick="performDestroy('{{ $checkoutDatas->id }}',this)" style="color:aliceblue"
                                    class="btn btn-danger">Delete</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @if ($checkout->amount == null)
                    @else
                    <td class="text-center" style="color: black">Total : <span style="color:#8321B9 ">${{$checkout->amount }}</span></td>
                        
                    @endif
                </tbody>
            </table>

        </div>
    </div>
    @endforeach
</div>
@endsection


@section('script')
<script>
    function performDestroy(id, reference) {
            confirmDestroy('/dashboard/purchase', id, reference)
        }
</script>


@endsection