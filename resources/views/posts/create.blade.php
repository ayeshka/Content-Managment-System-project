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
   {{-- https://github.com/basecamp/trix "trix edditer "--}}
   <input id="content" type="hidden" name="content">
  <trix-editor input="content"></trix-editor>
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

@section('scripts')
{{-- eddit trix library --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
{{-- from https://cdnjs.com/libraries/trix   "cdn trix"  --}}


{{-- flatpiker library --}}
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
{{-- from https://flatpickr.js.org/getting-started/ --}}

<script>

flatpickr('#publish_at', {   // this publish_at is id of the input of the Publish At input
enableTime: true // if we wont time we can pass the this object to the flatpikr function
})
</script>
@endsection

@section('css')
{{-- eddit trix library --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
{{-- from https://cdnjs.com/libraries/trix   "cdn trix"  --}}

{{-- flatpiker library --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
{{-- from https://flatpickr.js.org/getting-started/ --}}
@endsection



