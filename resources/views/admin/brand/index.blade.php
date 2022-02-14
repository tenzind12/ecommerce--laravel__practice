@extends('admin.admin_master')
@section('admin_content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        All Brands <b></b>
        </h2>
    </x-slot>

    <div class="container">
        <div class="row mt-5">

            <div class="col-md-8">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="card">
                    <div class="card-header">ALL BRAND</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Brand Name</th>
                                    <th scope="col">Brand image</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php ($i = 1)
                                @foreach ($brands as $i => $brand)
                                <tr>
                                    <!-- <th scope="row">{{$brands->firstItem()+$loop->index}}</th> -->
                                    <th scope="row">{{$i + $brands->firstItem()}}</th>
                                    <td>{{$brand->brand_name}}</td>
                                    <td><img src="{{asset($brand->brand_image)}}" alt="{{$brand->brand_name}}" width="50"></td>
                                    <td>
                                        @if($brand->created_at == NULL)
                                        <span class="text-danger">No data found</span>
                                        @else
                                            {{Carbon\Carbon::parse($brand->created_at)->diffForHumans()}}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('brand/edit/'.$brand->id) }}" class="btn btn-sm btn-info">Edit</a>
                                        <a href="{{ url('brand/delete/'.$brand->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{$brands->links()}}
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">ADD BRAND</div>
                    <div class="card-body">
                        <form action="{{route('store.brand')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="exampleInputEmail1">Brand Name</label>
                                <input name="brand_name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter category name">
                                @error('brand_name')<span class="text-danger">{{$message}}</span>@enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Brand Image</label>
                                <input name="brand_image" type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter category name">
                                @error('brand_image')<span class="text-danger">{{$message}}</span>@enderror
                            </div>

                            <button type="submit" class="btn btn-primary mt-2">Add Brand</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection