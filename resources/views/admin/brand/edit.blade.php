<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Brands <b></b>
        </h2>
    </x-slot>
    
    <div class="container">
        <div class="row mt-5">
            


            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">EDIT BRAND</div>
                    <div class="card-body">
                        <form action="{{url('brand/update/'.$brand->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="old_image" value="{{$brand->brand_image}}">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Brand Name</label>
                                <input name="brand_name" type="text" class="form-control" value="{{$brand->brand_name}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter category name">
                                @error('brand_name')<span class="text-danger">{{$message}}</span>@enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Brand Image</label>
                                <div class="form-group">
                                    <img src="{{asset($brand->brand_image)}}" alt="">
                                </div>
                                <input name="brand_image" type="file" value="{{$brand->brand_image}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter category name">
                                @error('brand_image')<span class="text-danger">{{$message}}</span>@enderror
                                
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Confirm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
