@extends('admin.admin_master')
@section('admin_content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        About Us <b></b>
        </h2>
    </x-slot>

    <div class="d-flex justify-content-between px-3">
        <h4>Home About Us</h4>
        <p><a href="{{route('add.about')}}" class="btn btn-outline-info">Add New About Us</a></p>
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
                    <div class="card-header">ABOUT US</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Short Description</th>
                                    <th scope="col">Long Description</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php ($i = 1)
                                @foreach ($aboutUs as $about)
                                <tr>
                                    <th scope="row">{{$i ++}}</th>
                                    <td>{{$about->title}}</td>
                                    <td>{{$about->short_description}}</td>
                                    <td>{{$about->long_description}}</td>
                                    <td>
                                        @if($about->created_at == NULL)
                                        <span class="text-danger">No data found</span>
                                        @else
                                            {{Carbon\Carbon::parse($about->created_at)->diffForHumans()}}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{url('home/about/edit/'.$about->id)}}" class="btn btn-sm btn-info">Edit</a>
                                        <a href="{{url('home/about/delete/'.$about->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
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