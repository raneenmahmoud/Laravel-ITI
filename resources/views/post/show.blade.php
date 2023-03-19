@extends('Layout.app')

@section('title') Index @endsection

@section('content')

<section class="container p-5">
    <div class="card mb-3">
            <div class="card-header">
                Post Info
            </div>
            <div class="card-body">
                <h5 class="card-title">Title: {{$post['title']}}</h5>
                <p class="card-text">Description: {{$post['description']}}</p>
            </div>
    </div>

    <div class="card mb-3">
            <div class="card-header">
                Post Creator Info
            </div>
            <div class="card-body">
                <h5 class="card-title">Name: {{$post['Posted_by']}}</h5>
                <p class="card-text">Created_At: {{$post['Created_by']}}</p>
            </div>
    </div>
</section>
@endsection