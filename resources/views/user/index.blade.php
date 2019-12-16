@extends('layouts.app')

@section('content')




<div class="card card-default">
<div class="card-header">
Users
</div>
<div class="card-body">
<!-- Here count the number of posts pass in the controller -->
@if($users->count() > 0)
<table class="table">
<thead>
<th>Image</th>
<th>Name</th>
<th>Email</th>
<th></th>
</thead>
<tbody>
@foreach($users as $user)
<tr>
<td>
<img src="https://www.pavilionweb.com/wp-content/uploads/2017/03/man-300x300.png" height="50px" width="50px" alt="">
</td>
<td>{{$user->name}}</td>
<td>
    {{ $user->email}}
</td>
<td>
    @if(!$user->isAdmin())
    <form action="{{ route('users.make-admin', $user->id)}}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success btn-sm">Make Admin</button>
    </form>

    @endif

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
