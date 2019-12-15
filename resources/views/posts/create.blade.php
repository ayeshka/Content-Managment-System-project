@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
   {{ isset($posts) ? 'Edite Post' : 'Add Post'}}
    </div>
    <div class="card-body">
        @include('partial.errors')
    <!-- we have to add enctype in the form if we not the multimedia in the form it's not going to be submitted to the server-->
    <form action="{{ isset($posts) ? route('posts.update', $posts->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($posts))
     @method('PUT')
    @endif
   <div class="form-group">
   <label for="title">Title</label>
   <input type="text" class="form-control" name="title" id="title" value="{{ isset($posts) ? $posts->title : ''}}">
   </div>
   <div class="form-group">
   <label for="description">Description</label>
   <textarea name="description" id="description" cols="5" rows="5" class="form-control" >{{ isset($posts) ? $posts->description : ''}}</textarea>
   </div>
   <div class="form-group">
   <label for="content">Content</label>
   {{-- https://github.com/basecamp/trix "trix edditer "--}}
   <input id="content" type="hidden" name="content"value="{{ isset($posts) ? $posts->content : ''}}">
  <trix-editor input="content"></trix-editor>
   </div>
   @if(isset($posts))
   <div class="form-group">
       <img src="{{asset('storage/'.$posts->image) }}" alt="" width="100%" >
   </div>
   @endif
   <div class="form-group">
   <label for="image">Image</label>
   <input type="file" class="form-control" name="image" id="image">
   </div>

   <div class="form-group">
       <label for="category">Category</label>
       <select name="category" id="category" class="form-control">
           @foreach($categorys as $category)
           <option value="{{ $category->id}}"
            @if(isset($posts))
            @if($category->id === $posts->categary_id)
            selected
            @endif
            @endif
            >
          {{ $category-> name}}
        </option>
           @endforeach

       </select>
   </div>

   <div class="form-group">
   <label for="publish_at">Publish At</label>
   <input type="publish_at" class="form-control" id="publish_at" name="publish_at" value="{{ isset($posts) ? $posts->published_at : ''}}">
   </div>
   @if($tags->count() > 0)
   <div class="form-group">
    <label for="tags">Tags</label>
    <select name="tags[]" id="tags" class="form-control" multiple>
        @foreach($tags as $tag)
     <option value="{{ $tag->id }}">
     {{$tag->name}}
     </option>
     @endforeach
    </select>
</div>
   @endif

   <div class="form-group">
   <button type="submit" class="btn btn-success">
       {{ isset($posts) ? 'Update Post' : 'Create Post'}}
   </button>
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



