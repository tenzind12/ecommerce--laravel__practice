@extends('admin.admin_master')
@section('admin_content')

<form class="w-50 m-auto mt-5">
  <div class="form-group mb-3">
    <label for="exampleInputEmail1">Current Passwrd</label>
    <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Current Password">
  </div>
  <div class="form-group mb-3">
    <label for="exampleInputPassword1">New Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="New Password">
  </div>
  <div class="form-group mb-3">
    <label for="exampleInputPassword1">Confirm Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password">
  </div>
  <button type="submit" class="btn btn-primary">SAve</button>
</form>

@endsection