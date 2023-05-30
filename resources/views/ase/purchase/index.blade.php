@extends('ase.dashboard')

@section('title', 'Purchase Transactions')

@section('style')

@endsection

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Purchase /</span> Transactions </h4>
    @php
    $reversedCheckouts = $checkouts->reverse();
    @endphp

    @foreach ($reversedCheckouts as $checkout)
    <div class="card mb-5">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> &nbsp; &nbsp; Order /</span> Transactions ({{
            $loop->iteration }})</h4>

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

                        <td class="align-left white-space-nowrap py-9">
                            <img src="{{ Storage::url($checkoutDatas->image) }}" alt="Product-image" width="100"
                                height="90" style="border-radius: 10px;">
                        </td>

                        <td class="align-middle">{{ $checkoutDatas->productName }}</td>

                        <td>{{ $checkoutDatas->pivot->quantity }}</td>

                        <td>${{!$checkoutDatas->flag ? $checkoutDatas->price :
                            $checkoutDatas->discount }}
                        </td>

                        <td>
                            <div class="btn-group">
                                <a onclick="performDestroy('{{ $checkoutDatas->id }}',this)" style="color:rgb(0, 0, 0)"
                                    class="btn btn-warning">Restore</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @if ($checkout->amount == null)
                    @else
                    <td class="text-left" style="color: black">Total : <span style="color:#a600ff ">${{$checkout->amount
                            }}</span></td>

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
