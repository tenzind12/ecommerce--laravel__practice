@extends('admin.admin_master')
@section('admin_content')
            <div class="col-8 m-auto">
                <div class="card">
                    <div class="card-header">EDIT SLIDER</div>
                    <div class="card-body">
                        <form action="{{url('slider/update/'.$slider->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="old_image" value="{{$slider->image}}">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input name="title" value="{{$slider->title}}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter title">
                                @error('title')<span class="text-danger">{{$message}}</span>@enderror
                            </div>

                            <div class="form-group mt-3">
                                <p><img src="{{asset($slider->image)}}" alt="{{$slider->title}}" width="50%"></p>
                                <label for="exampleFormControlFile1">Choose an image</label>
                                <input name="image" type="file" class="form-control-file" id="exampleFormControlFile1">
                                @error('image')<span class="text-danger">{{$message}}</span>@enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="exampleFormControlTextarea1">Enter description</label>
                                <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$slider->description}}</textarea>
                                @error('description')<span class="text-danger">{{$message}}</span>@enderror
                            </div>

                            <button type="submit" class="btn btn-primary mt-2">Confirm</button>
                        </form>
                    </div>
                </div>
            </div>
@endsection