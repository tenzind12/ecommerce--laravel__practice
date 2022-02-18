@extends('admin.admin_master')
@section('admin_content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Contact Form Message <b></b>
        </h2>
    </x-slot>

    <div class="d-flex justify-content-between px-3">
        <h4>Message</h4>
        <p><a href="{{route('add.contact')}}" class="btn btn-outline-info">Add Contact</a></p>
    </div>
    <div class="container">
        <div class="row ">
            <div class="col">
               
                <div class="card">
                    <div class="card-header">MESSAGES</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">Submitted At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php ($i = 1)
                                @foreach ($contactMessages as $message)
                                <tr>
                                    <th scope="row">{{$i ++}}</th>
                                    <td>{{$message->name}}</td>
                                    <td>{{$message->email}}</td>
                                    <td>{{$message->subject}}</td>
                                    <td>{{$message->message}}</td>
                                    <td>
                                        @if($message->created_at == NULL)
                                        <span class="text-danger">No data found</span>
                                        @else
                                            {{Carbon\Carbon::parse($message->created_at)->diffForHumans()}}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{url('admin/contact/message/delete/'.$message->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
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