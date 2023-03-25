@extends('layouts.app')


@section('content')
@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<form class="p-3" action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
   @csrf
  <div class="mb-4">
    <label class="form-label">Title</label>
    <input type="text" class="form-control" name="title">
  </div>
  <div class="mb-4">
    <label class="form-label">Description</label>
    <div class="form-floating">
        <textarea class="form-control" name="description" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
        <label for="floatingTextarea2">Post</label>
    </div>
  </div>
  <div class="input-group mb-3">
    <input class="form-control form-control-lg" id="formFileLg" name="image" type="file">
  </div>
  <div class="mb-3">
    <label for="exampleFormControlTextarea1" class="form-label">Post Creator</label>
    <select name="post_creator" class="form-control">
        @foreach($users as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
        @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-success">Create</button>
</form>

@endsection