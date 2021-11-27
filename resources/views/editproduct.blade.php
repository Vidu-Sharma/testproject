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
     
<div class="col-sm-6">
			<h1>Update Product</h1>
			<form action="" method="POST">
				@csrf
				@method('PUT')
				<div class="mb-3">
					      <label for="name">Product Name:</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" value ="{{$product->product_name}}" required>
                         <label for="name">Product Description:</label>
                          <input type="text" class="form-control" id="product_description" name="product_description" value ="{{$product->product_description}}" required>
                                              <h3>SELL ON</h3>
<label class="container">amazon
  <input type="checkbox" name="sell[]" value="amazon" <?php if(in_array('amazon',$checkBox)) echo "checked = 'checked'"; ?>>
  <span class="checkmark"></span>
</label>
<label class="container">flipkart
  <input type="checkbox" name="sell[]" value="flipkart" <?php if(in_array('flipkart',$checkBox)) echo "checked = 'checked'"; ?>>
  <span class="checkmark"></span>
</label>
<label class="container">snapdeal
  <input type="checkbox" name="sell[]" value="snapdeal" <?php if(in_array('snapdeal',$checkBox)) echo "checked = 'checked'"; ?>>
  <span class="checkmark"></span>
</label>

 <p>color:</p>
  <input type="radio" id="color1" name="color" value="Red" @if($product->product_color =='Red') checked  @else  @endif >
  <label for="color1">RED</label><br>
  <input type="radio" id="color2" name="color" value="Blue" @if($product->product_color =='Blue') checked  @else  @endif>
  <label for="color2">Blue</label><br>  
    <input type="radio" id="color3" name="color" value="Yellow" @if($product->product_color =='Yellow') checked  @else  @endif>
  <label for="color2">Yellow</label><br>  


                         <button type="submit" class="btn btn-primary" name="update_category">Update Product</button> 
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
</div>






	
@endsection