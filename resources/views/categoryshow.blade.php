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
            <div class="row">
             <a class="edit_button"  style="float:right;" href="{{ route('addcategory') }}">Add Category</a>

        </div>
			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Category Name</th>
						<th scope="col">Action</th>
					</tr>
                </thead>
                <tbody>
                	@foreach($categorys as $cat)
                	<tr>
                		<th>{{ $cat->id }}</th>
                		<td>{{ $cat->category_name }}</td>
                		<td>
                			<a href="{{ url('/edit',$cat->id)}}" class="btn btn-info btn-sm">Edit</a>
                			<a href="{{ url('/delete',$cat->id)}}" class="btn btn-danger btn-sm">Delete</a>
                		</td>

                	</tr>
                	@endforeach

                </tbody>
			</table>
    </div>
  </div>
</div>



@endsection