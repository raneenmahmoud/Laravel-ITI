@extends('Layout.app')

@section('title') Index @endsection

@section('content')
<div class="text-center">
<a href="{{route('posts.create')}}" class="mt-4 btn btn-success">Create Post</a>
</div>
    <table class="table mt-4">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>

            @foreach($posts as $post)
                <tr>
                    <td>{{$post['id']}}</td>
                    <td>{{$post['title']}}</td>
                    <td>{{$post['Posted_by']}}</td>
                    <td>{{$post['Created_by']}}</td>
                    <td  class="d-flex gap-3">
                    <x-button :link="route('posts.show', $post['id'])">View</x-button>
                    <x-button :link="route('posts.edit', $post['id'])" type="secondary"> Edit </x-button>
                    <x-button type="danger" > Delete </x-button>
                        <!-- <a href="{{route('posts.show', $post['id'])}}" class="btn btn-primary">View</a> -->
                        <!-- <a href="{{route('posts.edit', $post['id'])}}" class="btn btn-danger">Edit</a> -->
                        <!-- <a href="#" class="btn btn-danger">Delete</a> -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection