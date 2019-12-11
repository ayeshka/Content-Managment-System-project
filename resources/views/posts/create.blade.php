@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
    Add Post
    </div>
    <div class="card-body">
    <!-- we have to add enctype in the form if we not the multimedia in the form it's not going to be submitted to the server-->
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
   <div class="form-group">
   <label for="title">Title</label>
   <input type="text" class="form-control" name="title" id="title">
   </div>
   <div class="form-group">
   <label for="description">Description</label>
   <textarea name="description" id="description" cols="5" rows="5" class="form-control"></textarea>
   </div>
   <div class="form-group">
   <label for="content">Content</label>
   <textarea name="content" id="content" cols="5" rows="5" class="form-control"></textarea>
   </div>
   <div class="form-group">
   <label for="image">Image</label>
   <input type="file" class="form-control" name="image" id="image">
   </div>
   <div class="form-group">
   <label for="publish_at">Publish At</label>
   <input type="publish_at" class="form-control" id="publish_at" name="publish_at">
   </div>
   <div class="form-group">
   <button type="submit" class="btn btn-success">Create Post</button>
   </div>
    </form>
    </div>
</div>

@endsection

