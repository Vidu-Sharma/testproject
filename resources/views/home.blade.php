@extends('layouts.app')

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> -->


<div class="jumbotron">
  <div class="container text-center">
   
      <h1></h1>
    
      <h1>Test Project</h1>      
      <p>Welcome to the <span class="firstdiv">Test Project</span></p>
  
  </div>
</div>
           
<div class="slideshow-container-fluid">

<div class="mySlides fade">
 
  <img src="{{url('/images/freestocks.jpg')}}"style="width:100%">
  <div class="text">Jents</div>
</div>

<div class="mySlides fade">

  <img src="{{url('/images/unsplash.jpg')}}" style="width:100%">
  <div class="text">Ladies</div>
</div>

<div class="mySlides fade">
  <img src="{{url('/images/t-shirt.jpg')}}" style="width:100%">
  <div class="text">Kids</div>
</div>


</div>
<br>

<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
       <h2>SHOPPING</h2>
       <p>
       Shops are necessary places, where people go to buy their necessary things. Shopping is something which is loved by all of us. It is said that many people find shopping relaxing. I too believe that shopping is a relaxing thing as whenever I get too stressed or tensed. I often go for shopping. The shopping Mall Department Store is  a  favorite place. My experience is always pleasant. These shops stand by the sides of the road. These shops are good in structure. The shops are opened generally at 8 A.M. and are closed at 10 P.M. There were large crowds of people at the shops. . These days there is a new concept of shopping called online shopping. In online shopping you do not have to visit the stores and you can shop for your items by sitting at home only. I am not so big.  I can not go alone out side. But sometimes I go shopping with my parents. There are so many things in the shops. I like to go shops. I want to have a look to every shop. Sometimes I meet my friends, when I go shopping. It is very interesting to me. I love shopping.
       </p>
    </div>
  </div>
</div><br><br>

<script>
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 3000); // Change image every 3 seconds
}
</script>

@endsection
