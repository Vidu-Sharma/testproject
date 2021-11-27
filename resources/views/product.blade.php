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
      <form action="/product" method="POST" enctype="multipart/form-data">
        @csrf
           <div class="mb-3">
                <div class="flash-message">
                  @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                  @if(Session::has('alert-' . $msg))
                  <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                  </p>
                  @endif
                  @endforeach
                </div>
        <div class="mb-3">
                <label for="name">Product Name:</label>
                        <input type="text" class="form-control" id="product_name" placeholder="Enter Product Name" name="product_name" required>
                              <label for="name">Product Description:</label>
                           <input type="text" class="form-control" id="product_description" placeholder="Enter Product Description" name="product_description" required>
                             
                                                           <h3>SELL ON</h3>
                              <label class="container">amazon
                                <input type="checkbox" name="sell[]" value="amazon">
                                <span class="checkmark"></span>
                              </label>
                              <label class="container">flipkart
                                <input type="checkbox" name="sell[]" value="flipkart">
                                <span class="checkmark"></span>
                              </label>
                              <label class="container">snapdeal
                                <input type="checkbox" name="sell[]" value="snapdeal">
                                <span class="checkmark"></span>
                              </label>

                               <p>color:</p>
                                <input type="radio" id="color1" name="color" value="Red">
                                <label for="color1">RED</label><br>
                                <input type="radio" id="color2" name="color" value="Blue">
                                <label for="color2">Blue</label><br>  
                                <input type="radio" id="color3" name="color" value="Yellow">
                                <label for="color3">yellow</label><br><br>
                              

                                  <div class="input-group hdtuto control-group lst increment" >
      <input type="file" name="images[]" class="myfrm form-control">
      <div class="input-group-btn"> 
        <button class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
      </div>
    </div>
    <div class="clone hide">
      <div class="hdtuto control-group lst input-group" style="margin-top:10px">
        <input type="file" name="images[]" class="myfrm form-control">
        <div class="input-group-btn"> 
          <button class="btn btn-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
        </div>
      </div>
    </div>  
 
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
<script type="text/javascript">
    $(document).ready(function() {
      $(".btn-success").click(function(){ 
          var lsthmtl = $(".clone").html();
          $(".increment").after(lsthmtl);
      });
      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".hdtuto").remove();
      });
    });
</script>
@endsection