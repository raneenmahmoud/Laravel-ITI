@extends('Layout.app')

@section('title') Index @endsection

@section('content')
<div class="text-center">
<a href="{{route('posts.create')}}" class="mt-5 btn btn-success">Create Post</a>
</div>
    <table class="table mt-4 table table-striped table-lg">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>

            @foreach($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->created_at->format('Y-m-d')}}</td>
                    <td>{{$post->updated_at->format('Y h:i:s A')}}</td>

                    <td  class="d-flex gap-3">
                    <x-button :link="route('posts.show', $post->id)">View</x-button>
                    <x-button :link="route('posts.edit', $post->id)" type="secondary"> Edit </x-button>
                    <form action="{{route('posts.destroy', $post->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                            <!-- <button type="submit" class="btn btn-danger" onclick="return myFunction()"> Delete </button> -->
                            <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirm-delete-modal{{$post->id}}">
                        Delete
                        </button>

                        <!--Delete  Modal -->
                        <div class="modal fade" id="confirm-delete-modal{{$post->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm Delete</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h6> Are you sure, you want to delete this post? </h6>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Delete</button>
                            </div>
                            </div>
                        </div>
                        </div>
                    </form>
                    
                        <!-- <a href="{{route('posts.show', $post['id'])}}" class="btn btn-primary">View</a> -->
                        <!-- <a href="{{route('posts.edit', $post['id'])}}" class="btn btn-danger">Edit</a> -->
                        <!-- <a href="#" class="btn btn-danger">Delete</a> -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$posts->onEachSide(2)->links("pagination::bootstrap-4")}}
  <!-- <p>  {{ $posts->links() }} </p> -->
@endsection
