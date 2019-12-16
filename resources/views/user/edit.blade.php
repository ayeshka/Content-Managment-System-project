
@extends('layouts.app')

@section('content')
<div class="container">

            <div class="card">
                <div class="card-header">My Profile</div>

                <div class="card-body">

                    @include('partial.errors')
                    <form action="{{ route('users.update-profile')}}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $users->name }}">
                        </div>
                        <div class="form-group">
                            <label for="about">About</label>
                            <textarea name="about" id="about" cols="30" rows="10" class="form-control">{{$users->about}}</textarea>
                        </div>

                      <button type="submit" class="btn btn-success">Update Profile </button>

                    </form>
                </div>
            </div>
</div>
@endsection
