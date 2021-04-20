@extends('admin.app')
@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"> Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}"> Category</a></li>
@if (@$category)
<li class="breadcrumb-item active" aria-current="page">Update Category</li>
@else
<li class="breadcrumb-item active" aria-current="page">Add Category</li>
@endif

@endsection
@section('content')

<form action="
@if (@$category)
{{ route('admin.category.update',$category->id) }}
@else
{{ route('admin.category.store') }}
@endif" method="POST" >
    @csrf
    @if (@$category)
        @method('PUT')
    @endif
    <div class="form-group">
        <div class="col-md-12">
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        </div>
        <div class="col-md-12">
            @if (session()->has('message'))
    <div class="alert alert-success">
   {{ session('message') }}
    </div>
@endif
        </div>
      <label for="texturl">Title: </label>
      <input type="text" class="form-control" id="texturl" name="title" placeholder="Enter Title" value="{{ @$category->title }}">
      <p class="small">{{ config('app.url') }}/<span id="url">{{ @$category->slug }}</span></p>
        <input type="hidden" type="text" name="slug" id="slug" value="{{ @$category->slug }}">
    </div>
    <div class="form-group">
      <label for="editor">Description</label>
      <textarea name="description" class="form-control" id="editor" rows="10" cols="80">{!! @$category->description !!}</textarea>
    </div>
    <div class="form-group">
        @php
    $ids = ( isset($category->childrens) &&  $category->childrens->count()>0) ? array_pluck($category->childrens, 'id') : null
@endphp
        <label for="parent_id">Example single select</label>
        <select class="form-control" name="parent_id[]" id="parent_id" multiple>
            @if (isset($categories))
            <option value="0">Top Level</option>
            option
                @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" @if (isset($ids) && in_array($category->id, $ids)){{ 'selected' }} @endif>{{ $cat->title }}</option>
                @endforeach
            @endif
            option
        </select>
      </div>
@if (@$category)
<button type="submit" class="btn btn-primary">Update Category</button>
@else
<button type="submit" class="btn btn-primary">Add Category</button>
@endif

  </form>
@endsection
@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
    $('#texturl').on('keyup',function(){
        var url = slugify($(this).val());
        $('#url').html(url);
        $('#slug').val(url);
    })
$('#parent_id').select2({
    placeholder: "Select a Parent Category",
    allowClear: true,
    minimumResultsForSearch: Infinity
});

});
</script>

@endsection
