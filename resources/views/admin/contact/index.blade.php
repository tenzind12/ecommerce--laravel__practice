@extends('admin.admin_master')
@section('admin_content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Contact <b></b>
        </h2>
    </x-slot>

    <div class="d-flex justify-content-between px-3">
        <h4>Contact Page</h4>
        <p><a href="{{route('add.contact')}}" class="btn btn-outline-info">Add Contact</a></p>
    </div>
    <div class="container">
        <div class="row ">
            <div class="col">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="card">
                    <div class="card-header">CONTACT DATA</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php ($i = 1)
                                @foreach ($datas as $contact)
                                <tr>
                                    <th scope="row">{{$i ++}}</th>
                                    <td>{{$contact->address}}</td>
                                    <td>{{$contact->email}}</td>
                                    <td>{{$contact->phone}}</td>
                                    <td>
                                        @if($contact->created_at == NULL)
                                        <span class="text-danger">No data found</span>
                                        @else
                                            {{Carbon\Carbon::parse($contact->created_at)->diffForHumans()}}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{url('admin/contact/edit/'.$contact->id)}}" class="btn btn-sm btn-info">Edit</a>
                                        <a href="{{url('admin/contact/delete/'.$contact->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection