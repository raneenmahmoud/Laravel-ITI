@extends('Layout.app')

@section('title') Index @endsection

@section('content')
 
<form class="p-3" action="{{route('posts.store')}}" method="post">
   @csrf
  <div class="mb-4">
    <label class="form-label">Title</label>
    <input type="text" class="form-control" >
  </div>
  <div class="mb-4">
    <label class="form-label">Description</label>
    <div class="form-floating">
        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
        <label for="floatingTextarea2">Post</label>
    </div>
  </div>
  <div class="mb-4">
    <label class="form-label">Post Creator</label>
    <input type="text" class="form-control" >
  </div>
  <button type="submit" class="btn btn-success">Create</button>
</form>

@endsection