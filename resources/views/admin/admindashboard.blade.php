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
      <h4>WELCOME ADMIN</h4>

    </div>
  </div>
</div>
@endsection