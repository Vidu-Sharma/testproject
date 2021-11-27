@extends('layouts.app')
@section('content')

<div class="container-fluid">
  <div class="row content">
      <div class="col-sm-3 sidenav">
      <h4>  TEST PROJECT</h4>
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="{{ route('admin') }}">Home</a></li>
        <li class="nav-item"><a  class="nav-link" href="{{ route('categoryshow') }}">Category</a></li>
        <li class="nav-item"><a  class="nav-link" href="{{ route('productshow') }}">Products</a></li>
        <li class="nav-item"><a  class="nav-link" href="{{ route('userlist') }}">Setting</a></li>
      </ul>
    
    </div>

    <div class="col-sm-9 dashboard">
    	<form action="/category" method="POST">
				@csrf
				<div class="mb-3">
					      <label for="name">Category Name:</label>
                        <input type="text" class="form-control" id="category_name" placeholder="Enter Category Name" name="category_name" required>
                         <button type="submit" class="btn btn-primary" name="add_category">Submit</button> 
				</div>
			</form>
			@if(session()->has('status'))
			<div class="alert-success">
				{{session('status')}}
			</div>
			@endif

    </div>
  </div>
</div>
@endsection












	