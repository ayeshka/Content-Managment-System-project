@extends('layouts.app')

@section('content')

<div class=" card card-default">
<div class="card-header">
<!-- if is set categories then should change the name into eddit categiry else create categories -->
{{ isset($tags) ? 'Edite Tags' : 'Create Tags'}}
</div>
<div class="card-body">

<!-- Show a error massege -->
@if($errors->any())
<div class="alert alert-danger">
<ul class="list-group">
@foreach($errors->all() as $error)
<li class="list-group-item text-danger">{{ $error }}</li>
@endforeach
</ul>


</div>
@endif
<form action="{{ isset($tags) ? route('tags.update', $tags->id ) : route('tags.store')}}" method="POST">
<!-- this is the token -->
@csrf
@if(isset($tags))
@method('PUT')
@endif
<div class="form-group">
<label for="name">Name</label>
<input type="text" id="name" class="form-control" name="name" value="{{ isset($tags) ? $tags->name : '' }}" >
</div>
<div class="form-group">
<button class="btn btn-success">{{ isset($tags) ? 'Update Tag' : 'Add Tag'}}</button>
</div>
</form>
</div>

</div>

@endsection


