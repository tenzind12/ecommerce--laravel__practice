@extends('admin.admin_master')
@section('admin_content')

<form method="POST" action="{{route('password.update')}}" class="w-50 m-auto mt-5">
  @if(session('error'))
    <div class="alert alert-sucess alert-dismissible fade show" role="alert">
      <strong>{{session('error')}}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif
  @csrf
  <div class="form-group mb-3">
    <label for="current_password">Current Passwrd</label>
    <input type="password" class="form-control" name="old_password" id="current_password" placeholder="Current Password">
    @error('old_password')<span class="text-danger">{{$message}}</span>@enderror
  </div>
  <div class="form-group mb-3">
    <label for="password">New Password</label>
    <input type="password" class="form-control" name="password" id="password" placeholder="New Password">
    @error('password')<span class="text-danger">{{$message}}</span>@enderror
  </div>
  <div class="form-group mb-3">
    <label for="password_confirmation">Confirm Password</label>
    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
    @error('password_confirmation')<span class="text-danger">{{$message}}</span>@enderror
  </div>
  <button type="submit" class="btn btn-primary">Save</button>
</form>

@endsection