@extends('admin.admin_master')
@section('admin_content')
            <div class="col-8 m-auto">
                <div class="card">
                    <div class="card-header">EDIT CONTACT</div>
                    <div class="card-body">
                        <form action="{{url('/admin/contact/update/'.$contact->id)}}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="exampleInputEmail1">Contact Address</label>
                                <input name="address" value="{{$contact->address}}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter address">
                                @error('address')<span class="text-danger">{{$message}}</span>@enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input name="email" value="{{$contact->email}}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                @error('email')<span class="text-danger">{{$message}}</span>@enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone no.</label>
                                <input name="phone" value="{{$contact->phone}}" type="phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="075807****">
                                @error('phone')<span class="text-danger">{{$message}}</span>@enderror
                            </div>

                            <button type="submit" class="btn btn-primary mt-2">Confirm</button>
                        </form>
                    </div>
                </div>
            </div>
@endsection