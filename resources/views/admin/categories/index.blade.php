@extends('layouts.app')

@section('title', 'Admin: Categories')

@section('content')
<form action="{{ route('admin.categories.store') }}" method="post">
    @csrf

<div class="row gx-2 mb-4">
    <div class="col-4">
        <input type="text" name="name" placeholder="Add a category..." class="form-control" autofocus>
    </div>
    <div class="col-auto">
    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add</button></div>
    {{-- Error --}}
    </div>
    @error('name')
    <div class="text-danger small">{{ $message }}</div>
    @enderror
</form>
<div class="row">
    <div class="col-7">
<table class="table table-hover align-middle bg-white border table-sm text-secondary text-center">
    <thead class="small table-warning text-secondary">
        <tr>
            <th>#</th>
            <th>NAME</th>
            <th>COUNT</th>
            <th>LAST UPDATED</th>
            <th></th>
        </tr>
    </thead>

    @forelse($all_categories as $category) 
    {{-- if there are categories --}}
<tr>
<td>{{ $category->id }}</td>
<td class="text-dark">{{ $category->name }}</td>
<td>{{ $category->categoryPost->count() }}</td>
<td>{{ $category->updated_at }}</td>
<td>

    {{-- edit button --}}
    <button class="btn btn-outline-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#edit-category-{{ $category->id }}" title="Edit"><i class="fa-solid fa-pen"></i></a>
    </button>
       {{-- delete button --}}
       <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-category-{{ $category->id }}" title="Delete"><i class="fa-solid fa-trash-can"></i>
       </button>
</tr>
@include('admin.categories.modal.action')
    @empty
    {{-- else --}}
    <tr>
        <td colspan="5" class="lead text-muted text-center">No categories found.</td>
    </tr>
    @endforelse
    <tr>
    <td></td>
    <td class="text-dark">
        Uncategorized
        <p class="">
    </tr>
        </tbody>       
</table>
@include('admin.categories.modal.action')
<div class="de-flex justify-content-center">
    {{-- links for pagenate --}}
{{ $all_categories->links() }}
</div>

   


@endsection