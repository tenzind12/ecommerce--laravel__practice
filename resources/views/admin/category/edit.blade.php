<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        All Category <b></b>
        </h2>
    </x-slot>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 m-auto">
                <div class="card">
                    <div class="card-header">EDIT CATEGORY</div>
                    <div class="card-body">
                        <form action="{{ url('category/update/'.$categories->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Update Category Name</label>
                                <input name="category_name" value="{{$categories->category_name}}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter category name">
                                @error('category_name')<span class="text-danger">{{$message}}</span>@enderror
                            </div>
                            <button type="submit" class="btn btn-primary mt-3 ">Update Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
