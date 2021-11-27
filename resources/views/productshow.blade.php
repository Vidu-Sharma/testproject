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
             <a class="edit_button"  style="float:right;" href="{{ route('addproduct') }}">Add Product</a>

        </div>
              <table class="table table-hover ">
                                <thead class="thead-light">
                                        <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">Product description</th>
                                                <th scope="col">Product color</th>
                                                <th scope="col">Product sell</th>
                                                <th scope="col">image</th>
                                                <th scope="col">Action</th>
                                        </tr>
                </thead>
                <tbody>
                        @foreach($product as $prod=>$data)
                        <tr>
                                <th>{{ $data->id }}</th>
                                <td>{{ $data->product_name }}</td>
                                <td>{{ $data->product_description }}</td>
                                <td>{{ $data->product_color }}</td>
                                <td>{{ $data->product_sell }}</td>
                               <td>{{ $data->image}}</td>
    
                        
                                <td>
                                        <a href="{{ url('/editproduct',$data->id)}}" class="btn btn-info btn-sm">Edit</a>
                                        <a href="{{ url('/deleteproduct',$data->id)}}" onclick="return confirm('Delete Product?')" class="btn btn-danger btn-sm">Delete</a>
                                </td>

                        </tr>
                        @endforeach

                </tbody>
                        </table>

    </div>
  </div>
</div>
@endsection