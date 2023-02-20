@extends('ase.dashboard')

@section('title', 'Restore')

@section('style')

@endsection

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Restore /</span> categories</h4>

    <div class="card">
        <h5 class="card-header">Restore categories</h5>
        <div>
            <a href="{{ route('category.index') }}" class="btn btn-info" style="width: 150px">View All Users</a>
            <a href="{{ route('category.Restore.all') }}" class="btn btn-success" style="width: 150px">Restore All</a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Logo</th>
                        <th>Category Name</th>
                        <th>Deleted_at</th>
                        <th>Setting</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($categories as $categorie)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td class="align-middle white-space-nowrap py-0">
                            <img src="{{ Storage::url($categorie->image) }}" alt="Product-image" width="53"
                                style="border-radius: 10px;">
                        </td>
                        <td>{{ $categorie->categoryName }}</td>
                        <td>{{ $categorie->deleted_at }}</td>
                        <td>
                            <a href="{{ route('category.restore', $categorie->id) }}" style="color:aliceblue" 
                                class="btn btn-primary">Restore</a>
                            <a onclick="performDestroy('{{ $categorie->id }}',this)" style="color:aliceblue"  class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
    <script>
    function performDestroy(id, reference) {
            confirmDestroy('/dashboard/RestoreCategoryDestroy', id, reference)
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