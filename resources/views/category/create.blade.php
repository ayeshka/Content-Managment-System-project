@extends('layouts.app')

@section('content')

<div class=" card card-default">
<div class="card-header">
Create Categories
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
<form action="{{route('categories.store')}}" method="POST">
<!-- this is the token -->
@csrf
<div class="form-group">
<label for="name">Name</label>
<input type="text" id="name" class="form-control" name="name" >
</div>
<div class="form-group">
<button class="btn btn-success">Add category</button>
</div>
</form>
</div>

</div>

@endsection
