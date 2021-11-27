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
        <h3>Update User</h3>
      <form action="" method="POST">
          @csrf
        @method('PUT')
        <div class="mb-3">

                <label for="name"> Name:</label>
                 <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{$users->name}}"required>
                              <label for="name">Email</label>
                           <input type="text" class="form-control" id="email" placeholder="email" name="email" value="{{$users->email}}"required>
  
                              <label for="cars">Choose User Role:</label>
                                  <select name="role" id="role">
                                    
                                   @foreach($roles as $role)
                                    <option value="{{ $role->title }}">{{ $role->title }}</option>
                                    
                                  @endforeach
                                  </select> 

 
                         <button type="submit" class="btn btn-primary" name="update_user">Update User</button> 
        </div>
      </form>
   
    </div>

	</div>
</div>
@endsection