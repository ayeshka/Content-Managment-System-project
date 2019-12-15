@extends('layouts.app')

@section('content')

<div class=" card card-default">
<div class="card-header">
<!-- if is set categories then should change the name into eddit categiry else create categories -->
{{ isset($categories) ? 'Edite Categories' : 'Create Categories'}}
</div>
<div class="card-body">

<!-- Show a error massege -->
@include('partial.errors')

<form action="{{ isset($categories) ? route('categories.update', $categories->id ) : route('categories.store')}}" method="POST">
<!-- this is the token -->
@csrf
@if(isset($categories))
@method('PUT')
@endif
<div class="form-group">
<label for="name">Name</label>
<input type="text" id="name" class="form-control" name="name" value="{{ isset($categories) ? $categories->name : '' }}" >
</div>
<div class="form-group">
<button class="btn btn-success">{{ isset($categories) ? 'Update Category' : 'Add Category'}}</button>
</div>
</form>
</div>

</div>

@endsection


