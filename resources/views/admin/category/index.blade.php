<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        All Category <b></b>
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">

            <div class="col-md-8">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="card">
                    <div class="card-header">ALL CATEGORY</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php ($i = 1)
                                @foreach ($categories as $i => $category)
                                <tr>
                                    <!-- <th scope="row">{{$categories->firstItem()+$loop->index}}</th> -->
                                    <th scope="row">{{$i + $categories->firstItem()}}</th>
                                    <td>{{$category->category_name}}</td>
                                    <td>{{$category->user->name}}</td>
                                    <td>
                                        @if($category->created_at == NULL)
                                        <span class="text-danger">No data found</span>
                                        @else
                                            {{Carbon\Carbon::parse($category->created_at)->diffForHumans()}}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('category/edit/'.$category->id) }}" class="btn btn-sm btn-info">Edit</a>
                                        <a href="{{ url('category/softdelete/'.$category->id) }}" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{$categories->links()}}
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">ADD CATEGORY</div>
                    <div class="card-body">
                        <form action="{{route('store.category')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Category Name</label>
                                <input name="category_name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter category name">
                                @error('category_name')<span class="text-danger">{{$message}}</span>@enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Add Category</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!--------------------------- soft trash container ----------------------->
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">TRASHED CATEGORY</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trashCat as $i => $trash)
                                <tr>
                                    <th scope="col">{{$i + $trashCat->firstItem()}}</th>
                                    <td>{{$trash->category_name}}</td>
                                    <td>{{$trash->user->name}}</td>
                                    <td>{{$trash->created_at}}</td>
                                    <td>
                                        <a href="{{ url('category/restore/'.$trash->id) }}" class="btn btn-sm btn-info">Restore</a>
                                        <a href="{{ url('category/pdelete/'.$trash->id) }}" class="btn btn-sm btn-danger">P. Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$trashCat->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
