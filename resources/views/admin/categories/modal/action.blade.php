{{-- Edit --}}
<div class="modal fade" id="edit-category-{{ $category->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-warning">
            <div class="modal-header border-warning">
                <h3 class="h5 moda-title text-secondary">
                <i class="fa-solid fa-pen-to-square"></i>Edit Category
                </h3>
            </div>
            <form action="{{ route('admin.categories.update', $category->id) }}" method="post">
                @csrf
                @method('PATCH')
            <div class="modal-body">
                <div class="col">
                    <input type="text" name="name" placeholder="{{ $category->name }}" class="form-control" autofocus>
                </div>
            </div>
            <div class="modal-footer border-0">
                   

                    <button type="button" class="btn btn-warning btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning btn-sm">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Delete --}}
<div class="modal fade" id="delete-category-{{ $category->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="h5 moda-title text-danger">
                <i class="fa-solid fa-trash-can"></i> Delete Category
                </h3>
            </div>
            <div class="modal-body">
                Are you sure you want to delete <span class="dw-bold">{{ $category->name }}</span>?
                <div>This action will affect all the posts under this category. Posts without a category will fall under Uncategorized.</div>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.categories.delete', $category->id) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- @endif --}}