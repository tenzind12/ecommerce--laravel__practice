@extends('admin.admin_master')
@section('admin_content')
            <div class="col-8 m-auto">
                <div class="card">
                    <div class="card-header">ADD ABOUT US</div>
                    <div class="card-body">
                        <form action="{{route('store.about')}}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input name="title" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter title">
                                @error('title')<span class="text-danger">{{$message}}</span>@enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="exampleFormControlTextarea1">Short Description</label>
                                <textarea name="short_description" class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                                @error('short_description')<span class="text-danger">{{$message}}</span>@enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="exampleFormControlTextarea1">Long Description</label>
                                <textarea name="long_description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                @error('long_description')<span class="text-danger">{{$message}}</span>@enderror
                            </div>

                            <button type="submit" class="btn btn-primary mt-2">Add Slider</button>
                        </form>
                    </div>
                </div>
            </div>
@endsection