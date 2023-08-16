@extends('layouts.site_layout')
@section('title')
Home
@endsection
@section('section')
<div class="container">
  <div class="mt-3">
      <a href="{{ route('add_student') }}" class="btn btn-primary">Add new</a>
  </div>
  <div>
      <table class="table">
          <thead>
              <tr>
                  <th scope="col">Sr No</th>
                  <th scope="col">Name</th>
                  <th scope="col">Phone</th>
                  <th scope="col">Email</th>
                  <th scope="col">Class</th>
                  <th scope="col">Address</th>
                  <th scope="col">Phote</th>
                  <th scope="col">DOB</th>
                  <th scope="col">Action</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($student as $var )
            <tr>
                <th scope="row">{{ $loop->iteration}}</th>
                <td>{{ $var->name}}</td>
                <td>{{ $var->phone}}</td>
                <td>{{ $var->email}}</td>
                <td>{{ $var->class}}</td>
                <td>{{ $var->address}}</td>
                <td> <img src="{{asset('image')}}/{{$var->image}}" style="width: 50px; height:50px;" alt="image"> </td>
                <td>{{$var->dob}}</td>
                <td><a href="{{route('edit_student', $var->id)}}" class="bt btn-primary small">edit</a>
                <a href="{{route('delete_student', $var->id)}}" class="bt btn-primary small">delete</a>
                </td>
            </tr>
            @endforeach
          
          </tbody>
      </table>
  </div>
</div>
@endsection




