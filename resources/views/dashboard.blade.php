<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        Hi... <b>{{Auth::user()->name}}</b>

        </h2>
    </x-slot>

    <div class="container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">SL No</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Created At</th>
            </tr>
        </thead>
        <tbody>
            {{count($userData)}}
            @php($i = 1)
            @forelse ($userData as $data)
            <tr>
                <th scope="row">{{$i++}}</th>
                <td>{{$data->name}}</td>
                <td>{{$data->email}}</td>
                <td>{{Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</td>
            </tr>
            @empty
            <p>No users</p>
            @endforelse
        </tbody>
        </table>
    </div>

</x-app-layout>
