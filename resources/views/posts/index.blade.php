@extends('layouts.app')

@section('content')


<div class="div d-flex justify-content-end mb-2">
<a href="{{ route('posts.create')}}" class="btn btn-success ">Add Posts</a>
</div>

<div class="card card-default">
<div class="card-header">
Posts
</div>
<div class="card-body">
<!-- Here count the number of posts pass in the controller -->
@if($posts->count() > 0)
<table class="table">
<thead>
<th>Image</th>
<th>Title</th>
</thead>
<tbody>
@foreach($posts as $post)
<tr>
<!-- First thing I did know is the storage folder is secure, the public folder where we keep our asset like css,js and image
So if we ever want our image to display we need to move it to the public folder but lareval provide simple command
we can use to do  that and it called at storagelink  "use this commad to do that, php artisan storage:link" then
it's link both public folder-->
<td>
<!-- asset ditectly access to the public folder threfor path should be currect -->
<img src="{{ asset('storage/'.$post->image) }}" width="120px" height="60px" alt="image">
</td>
<td>{{$post->title}}</td>
@if($post->trashed())
<td>
<form action="{{ route('restore-posts', $post->id )}}" method="POST">
@csrf
@method('PUT')
<button class="btn btn-info btn-sm" type="submit">Restore</button>
</form>


</td>
@else
<td>
<a href="{{ route('posts.edit', $post->id )}}" class="btn btn-info btn-sm">Edit</a>
</td>
@endif
<td>
<form action="{{ route('posts.destroy', $post->id)}}" method="POST">
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger btn-sm">
{{ $post->trashed() ? 'Delete' : 'Trash'}}
</button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>

@else
<h3 class="text-center">No Post Yet</h3>
@endif

</div>
</div>


@endsection
