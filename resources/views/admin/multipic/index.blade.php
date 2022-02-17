@extends('admin.admin_master')
@section('admin_content')

    <div class="container">
        <div class="row mt-5">

            <div class="col-md-8">
                <div class="card-group">
                    @foreach($images as $image)
                        <div class="col-sm-4">
                            <div class="card">
                                <img src="{{asset($image->image)}}" alt="multi image" class="m-2">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">MULTI IMAGE</div>
                    <div class="card-body">
                        <form action="{{route('store.image')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Brand Image</label>
                                <input name="image[]" type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter category name" multiple>
                                @error('image')<span class="text-danger">{{$message}}</span>@enderror
                            </div>

                            <button type="submit" class="btn btn-primary mt-2">Add Image</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection