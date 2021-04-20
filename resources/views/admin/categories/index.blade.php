@extends('admin.app')
@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"> Dashboard</a></li>
<li class="breadcrumb-item active" aria-current="page">Category</li>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-6 col-md-4"><h2>Categories</h2></div>
  <div class="col-6 col-md-4">&nbsp;</div>
  <div class="col-6 col-md-4 text-right"><a href="{{ route('admin.category.create') }}">
    <button type="button"  class="btn btn-sm btn-outline-secondary ">Add New Category</button></a></div>

    </div>
</div>
<div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th>#</th>
          <th>Title</th>
          <th>Description</th>
          <th>Slug</th>
          <th>Categories</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
          @if($categories)
          @foreach ($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
          <td>{{ $category->title }}</td>
          <td>{!! $category->description !!}</td>
          <td>{{ $category->slug }}</td>
          <td>
              @if($category->childrens()->count()>0)
                    @foreach ($category->childrens as $children)
                    {{$children->title}},
                    @endforeach
              @else
                  <strong>{{"Parent Category"}}</strong>
              @endif
          </td>
          <td><a class="btn btn-info btn-sm" href="{{ route('admin.category.edit', $category->id) }}">Edit</a> | <a class="btn btn-danger btn-sm" href="javascript" onclick="deleteRecord('{{ $category->id }}')">Delete</a>
        <form action="{{ route('admin.category.destroy',$category->id) }}" id="delete-category" method="post" style="display: none">
        @method('DELETE')
        @csrf
        </form>
        </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="5">No Category Found...</td>
          </tr>
        @endif

      </tbody>
    </table>

  </div>
  {{-- <div class="row">
    <div class="col-md-12"> --}}
        {{ $categories->links() }}
    {{-- </div>
</div> --}}
@endsection
