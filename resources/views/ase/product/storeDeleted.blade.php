@extends('ase.dashboard')

@section('title', 'Restore Product')

@section('style')

@endsection

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Restore /</span> Product</h4>

    <div class="card">
        <h5 class="card-header">Restore Product</h5>
        <div>
            <a href="{{ route('products.index') }}" class="btn btn-info" style="width: 150px">View All Users</a>
            <a href="{{ route('products.Restore.all') }}" class="btn btn-success" style="width: 150px">Restore All</a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Logo</th>
                        <th>Store</th>
                        <th>Category Name</th>
                        <th>Discreption</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Flag</th>
                        <th>Deleted_at</th>
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
                        <td>{{ $product->category->categoryName }}</td>
                        <td>{{ $product->productName }}</td>
                        <td>{{ $product->discreption }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->discount }}</td>
                        <td>
                            @if ($product->flag)
                            Discount
                            @else
                            Price
                            @endif
                        </td>
                        <td>{{ $product->deleted_at }}</td>
                        <td>
                            <a href="{{ route('products.restore', $product->id) }}" style="color:aliceblue"
                                class="btn btn-primary">Restore</a>
                            <a onclick="performDestroy('{{ $product->id }}',this)" style="color:aliceblue"
                                class="btn btn-danger">Delete</a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
    <script>
    function performDestroy(id, reference) {
            confirmDestroy('/dashboard/Restoredestroy', id, reference)
        }
    </script>

    <script type="text/javascript">
    $('.show_confirm').click(function(e) {
            if (!confirm('Are you sure you want to delete this?')) {
                e.preventDefault();
            }
        });
    </script>


@endsection