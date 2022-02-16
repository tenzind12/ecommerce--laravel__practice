@extends('admin.admin_master')
@section('admin_content')
            <div class="col-8 m-auto">
                <div class="card">
                    <div class="card-header">ADD ABOUT US</div>
                    <div class="card-body">
                        <form action="{{url('home/about/update/'.$edit->id)}}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input name="title" value="{{$edit->title}}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter title">
                                @error('title')<span class="text-danger">{{$message}}</span>@enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="exampleFormControlTextarea1">Short Description</label>
                                <textarea name="short_description" class="form-control" id="exampleFormControlTextarea1" rows="2">{{$edit->short_description}}</textarea>
                                @error('short_description')<span class="text-danger">{{$message}}</span>@enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="exampleFormControlTextarea1">Long Description</label>
                                <textarea name="long_description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$edit->long_description}}</textarea>
                                @error('long_description')<span class="text-danger">{{$message}}</span>@enderror
                            </div>

                            <button type="submit" class="btn btn-primary mt-2">Confirm</button>
                        </form>
                    </div>
                </div>
            </div>
@endsection