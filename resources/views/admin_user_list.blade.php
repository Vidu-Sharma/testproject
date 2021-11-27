@extends('layouts.app')
@section('content')
<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <h4>  TEST PROJECT</h4>
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="{{ route('admin') }}">Home</a></li>
        <li class="nav-item"><a  class="nav-link" href="{{ route('categoryshow') }}">Category</a></li>
        <li class="nav-item"><a  class="nav-link" href="{{ route('productshow') }}">Products</a></li>
        <li class="nav-item"><a  class="nav-link" href="{{ route('userlist') }}">Setting</a></li>
      </ul>
    
    </div>
    <div class="col-sm-10 dashboard">
         <h3>USER List</h3>
         <div class="row">
             <a class="edit_button"  style="float:right;" href="{{ route('roleshow') }}">Role List</a>

        </div>

       
              <table class="table table-hover ">
                                <thead class="thead-light">
                                        <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Role</th>
                                               <th scope="col">Action</th>
                                        </tr>
                </thead>
                <tbody>

                        @foreach($users as $us)
                        <tr>

                                <th>{{ $us->id }}</th>
                                <td>{{ $us->name }}</td>
                                <td>{{ $us->email }}</td>
                                <td>{{ $us->role }}</td>
                               
                                <td>
                                        <a href="{{ url('/edituserlist',$us->id)}}" class="btn btn-info btn-sm">Edit</a>
                                        <a href="{{ url('/deleteuser',$us->id)}}" onclick="return confirm('Delete User?')" class="btn btn-danger btn-sm">Delete</a>
                                </td>

                               
                        </tr>
                        @endforeach

                </tbody>
                        </table>

    </div>
  </div>
</div>
@endsection