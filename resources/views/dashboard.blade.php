@extends('layout')

@section('header')
<li><a href="#map" class="scrollable">Map</a></li>
<li><a href="#portfolio" class="scrollable">New</a></li>
<li><a href="#contact" class="scrollable">Share</a></li>
<!-- <li id="loggedin"><a onclick="popupLogin()">Login</a></li> -->

<!-- <div id = "loginModal" class = "modal">
<div class = "modal-content">
<div class="row">
<div class="col-md-6">
<label id="errorMessage" style="display: none; color:red;">Sorry, could not match email&password</label>
<h3>Login</h3>
	<form action="{{ route('signin') }}" method="post">
		<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
			<label for="email">email</label>
			<input class="form-control" type="text" name="email" id="email" value="{{ Request::old('email') }}">
		</div>
		<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
			<label for="password">password</label>
			<input class="form-control" type="password" name="password" id="password" value="{{ Request::old('password') }}">
		</div>
			<button type="submit" class="btn btn-primary">Submit</button>
			<input type="hidden" name="_token" value="{{ Session::token() }}">
	</form>
</div>
<div class="col-md-6">
	<h3>Signup</h3>
	<form action="{{ route('signup') }}" method="post">
		<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
			<label for="email">email</label>
			<input class="form-control" type="text" name="email" id="email" value="{{ Request::old('email') }}">
		</div>
		<div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
			<label for="first_name">username</label>
			<input class="form-control" type="text" name="first_name" id="first_name" value="{{ Request::old('first_name') }}">
		</div>
		<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
			<label for="password">password</label>
			<input class="form-control" type="password" name="password" id="password" value="{{ Request::old('password') }}">
		</div> -->
		<!-- <div class="form-group {{ $errors->has('profileImage') ? 'has-error' : '' }}">
			<label for="profileUrl">Profile Image</label>
			<input type="file" name="profileUrl"　id="profileButton" title=" " value=""/>
		</div> -->
		<!-- <div class="form-group">
			<input type="text" name="image" id="image" value="hi"/>
		</div> -->
			<!-- <button type="submit" class="btn btn-primary" id="submit">Submit</button>
			<input type="hidden" name="_token" value="{{ Session::token() }}">
	</form>
</div>
</div>
</div> -->

<script>
// //When login is failed, error message will be displayed
// @if($login)
// document.getElementById("loginModal").style.display = "block";
// document.getElementById("errorMessage").style.display = "block";
// @endif
//
// // login button is clicked
// function popupLogin(){
// 	document.getElementById("loginModal").style.display = "block";
// 	document.getElementById("errorMessage").style.display = "none";
// }
//
// // login button is changed to logout when a user is logged in
// @if(Auth::user())
// document.getElementById("loggedin").innerHTML = '<a href="{{ route('logout') }}">Logout</a>';
// @endif

// profile image is uploaded to firebase and get the url
//var profileButton = document.getElementById('profileButton');
//var submitButton = document.getElementById('submitButton');

// profileButton.addEventListener('change',function(e){
// 		if(profileValidate()){
// 			var file = e.target.files[0];
// 			var storageRef = firebase.storage().ref(file.name);
// 			storageRef.put(file);
// 			storageRef.getDownloadURL().then(function(url) {
// 				var profileUrl = url;
// 				// document.getElementById('image').value = "yesyes";
// 			});
// 		}
// });
//
// function profileValidate(){
// 	var image = document.getElementById('profileButton');
// 	var imageUploadPath = image.value;
//
// 	//To check if user upload any file
// 	if (imageUploadPath != '') {
// 		var extension = imageUploadPath.substring(
// 			imageUploadPath.lastIndexOf('.') + 1).toLowerCase();
//
// 			//The file uploaded is an image
// 			if (extension == "gif" || extension == "png" || extension == "bmp"
// 			|| extension == "jpeg" || extension == "jpg") {
// 				return true;
// 			}
// 			return false;
// 		}
// 	}
</script>
<!-- end header-->
@stop

<!-- Adding Top Image-->
@section('topImage')
<a href="#map" class="scrollable"> <img id="topImage" src="https://firebasestorage.googleapis.com/v0/b/laravel-659e1.appspot.com/o/pexels-photo-109917.jpg?alt=media&token=abda039d-28ef-4d7b-95f1-3c9c317614ff" style="width: 100%;"/> </a>
@stop

<!-- Adding Map -->
@section('map')
<!-- <div id="floating-panel"></div> -->
<div id="map"></div>
<div id = "myModal" class = "modal">
<div class = "modal-content">
	<strong><p id = "disp" style = "color: #9E9E9E"></p></strong>
</div>
</div>
<script>
var map;
function initMap() {
  if ($(window).width() <= 768){
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 40.4168, lng: 5.7038},
    zoom: 1,
    scrollwheel: false
  });
} else {
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 40.4168, lng: 5.7038},
    zoom: 2,
    scrollwheel: false
  });
}
  var geocoder = new google.maps.Geocoder();
  var totalTravellers = 0;
  @foreach ($database as $data)
    geocodeAddress(geocoder, map, "{{$data->imageLocation}}", "{{$data->imageUrl}}", "{{$data->imageStory}}");
    totalTravellers++;
  @endforeach
  // document.getElementById("floating-panel").innerHTML = totalTravellers + " Travellers Visited ";

  google.maps.event.addDomListener(window, "resize", function() {
   var center = map.getCenter();
   google.maps.event.trigger(map, "resize");
   map.setCenter(center);
});
}

 function geocodeAddress(geocoder, resultsMap, address, url,story) {
  geocoder.geocode({'address': address}, function(results, status) {
    if (status === 'OK') {
      var marker = new google.maps.Marker({
        map: resultsMap,
        position: results[0].geometry.location,
      });
      attachLocation(marker, url, address);
      marker.addListener('click', function() {
            popupImage(url,story,address);
      });
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}

function attachLocation(marker, url, address) {
  var infowindow = new google.maps.InfoWindow({
    content: "<img src=" + url + " width=150px> " + "<br/>"+ address,
    disableAutoPan: true
  });

if ($(window).width() >= 768){
  marker.addListener('mouseover', function() {
    infowindow.open(marker.get('map'), marker);
  });
}

  marker.addListener('mouseout', function() {
    infowindow.close(marker.get('map'), marker);
  });
}

var modal = document.getElementById("myModal");
function popupImage(url,story,address){
    modal.style.display = "block";
		if ($(window).width() < 768){
			document.getElementById("disp").innerHTML = "<center> <img src=" + url + " width=90%><br/><br/>"
	    + story + "<br/>-" + address + "</center>";
		} else {
			document.getElementById("disp").innerHTML = "<center> <img src=" + url + " width=70%><br/><br/>"
	    + story + "<br/>-" + address + "</center>";
		}
}

$(window).on('click touchstart', function(event){
	if(event.target == modal)
	{
		modal.style.display = "none";
	}
});

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoCNaVtm5v0u6cQ5FOxBBhkSIQ0LiZJXc&callback=initMap"
async defer></script>
<script type="text/javascript">

</script>
@stop

@section('new')
<section id="portfolio">
	<br/>
  <h2 style="color:#ff5722">New Location</h2>
  <ul class="grid">
		@foreach ($database as $data)
		<li><img src="{{ $data->imageUrl }}" alt="image not available">
			<div class="row">
			<div class="col-md-10 col-xs-9">
				<font color="#666"> {{$data->imageStory}} </br>-{{$data->imageLocation}} </font>
			</div>
			<div class="col-md-2 col-xs-3">
				<img id="travellers" src="{{ $data->profileUrl}}"></img>
			</div>
		</div>
	</li>
		@endforeach
  </ul>
</section>
@stop

@section('share')
<section id="contact"  style="background-color:rgba(255, 87, 34, 0.94); color:#fff;">
    <br/>
    <h2 style="color:#fff">Share Your Travel Experience</h2>
    <hr class="style-white"/>

      <div class="container">
				<div class="alert alert-danger" id="validationFail">
					<strong>Whoops!</strong>&nbsp There was a problem with file type.
					<button type="button" class="close" data-dismiss="alert">×</button>
				</div>

				<div class="alert alert-success alert-block" id="validationSuccess">
					<strong>Image Uploaded successfully.</strong>
					<button type="button" class="close" data-dismiss="alert">×</button>
				</div>

				<div class="alert alert-danger" id="validationLocation">
					<strong>Whoops!</strong>&nbsp There was a problem with location.
					<button type="button" class="close" data-dismiss="alert">×</button>
				</div>

      <form id="contactForm" novalidate="" action="{{ url('/#contact') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-item">
          <input id="name" type="text" placeholder="Name" required/>
        </div>
        <div class="form-item">
          <input id="location" rows="5" placeholder="Location (City,State)" required/></input>
        </div>
        <div class="form-item">
          <textarea id="message" rows="5" placeholder="Your Travel Story" required/></textarea>
        </div>
				<!-- <label>Profile Image</label>
				<input type="file" value="upload" id="profileButton"/></br> -->
				<label>Travelling Image</label>
        <input type="file" value="upload" id="fileButton"/></br>
        </br>
        <input type="button" value="Share!" id="shareButton" style="background-color:#ff5722" onclick="validateInput()"/></br>
      </br>
      </form>
</div>
  </br>
  </section>
  <script src="https://www.gstatic.com/firebasejs/3.5.3/firebase.js"></script>
  <script>
  // if(localStorage.validationSuccess=="TRUE"){
  //   document.getElementById('validationSuccess').style.display = "block";
  //   localStorage.setItem("validationSuccess", "FALSE");
  // }
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyDOwreQX85mVM0k6M4bdK21SLZ-NY-J484",
    authDomain: "laravel-659e1.firebaseapp.com",
    databaseURL: "https://laravel-659e1.firebaseio.com",
    storageBucket: "laravel-659e1.appspot.com",
    messagingSenderId: "787528647984"
  };
  firebase.initializeApp(config);

  var fileButton = document.getElementById('fileButton');
	var profileButton = document.getElementById('profileButton');
  var shareButton = document.getElementById('shareButton');
	var usernameInput = document.getElementById('name');

	// usernameInput.addEventListener('change',function(e){
	// 	checkLogin();
	// });
	//
	// function checkLogin(){
	// 	@if(Auth::user())
	// 		return true;
	// 	@else
	// 		document.getElementById("loginModal").style.display = "block";
	// 		document.getElementById("errorMessage").style.display = "block";
	// 		document.getElementById("errorMessage").innerHTML = "Please login before sharing your story";
	// 		return false;
	// 	@endif
	// }

	function validateInput(){
		var message = document.getElementById('message').value;
		var imageLocation = document.getElementById('location').value;

		locationValidate(imageLocation, function(results) {
			if (results) {
				imageValidate(function(ImageResults) {
					if (ImageResults) {
						alert("true true callback is working");
						var file = document.getElementById('fileButton').files[0];
						var storageRef = firebase.storage().ref(file.name);
						storageRef.put(file);
						alert("put is working");

						storageRef.getDownloadURL().then(function(url) {
							var imageUrl = url;
							$.get("/test?url=" + imageUrl + '&message='+message + '&location=' + imageLocation);
							$('#portfolio').load(document.URL +  ' #portfolio');
							document.getElementById('validationSuccess').style.display = "block";
							document.getElementById("contactForm").reset();
							document.getElementById("shareButton").value = "Share!";
							// document.getElementById("shareButton").value = "Share!";
						});
						alert("end is working");
					}
					else{
						alert("true false callback is working");
					}
				});
			}
			else {
				alert("false callback is working");
			}
});

			// var file = t_image.target.files[0];
			// var storageRef = firebase.storage().ref(file.name);
			// storageRef.put(file);
			// storageRef.getDownloadURL().then(function(url) {
			// 	var imageUrl = url;
			// 	$.get("/test?url=" + imageUrl + '&message='+message + '&location=' + imageLocation);
			// 	$('#portfolio').load(document.URL +  ' #portfolio');
			// 	document.getElementById('validationSuccess').style.display = "block";
			// });
	}

		function locationValidate(imageLocation, callback){
				var geocoder = new google.maps.Geocoder();
				//Check if imageLocation is valid
				geocoder.geocode({'address': imageLocation}, function(results, status) {
					if (status !== 'OK') {
						document.getElementById('validationLocation').style.display = "block";
						callback(null);
					}
					else {
						callback(results);
					}
				});
			}

      function imageValidate(callback){
        var image = document.getElementById('fileButton');
        var imageUploadPath = image.value;

        //To check if user upload any file
        if (imageUploadPath != '') {
          var extension = imageUploadPath.substring(
            imageUploadPath.lastIndexOf('.') + 1).toLowerCase();

            //The file uploaded is an image
            if (extension == "gif" || extension == "png" || extension == "bmp"
            || extension == "jpeg" || extension == "jpg") {
              // document.getElementById('validationSuccess').style.display = "block";
              document.getElementById('validationFail').style.display = "none";
							document.getElementById('validationLocation').style.display = "none";
							callback("true");
            }
            //The file upload is NOT an image
            else {
              document.getElementById('validationFail').style.display = "block";
              document.getElementById('validationSuccess').style.display = "none";
              callback(null);
            }
          }
        }
</SCRIPT>
  </script>
@stop

@section('footer')
<!-- Footer-->
<footer>
	<div id="footer-above" style="color: #ff5722">
		<div>
			<h3>Would you like to give us feedback? <a onclick="popupEmail()">Email Us</a></h3>
		</div>
		<div>
			<h3>Travellers</h3>
			@foreach ($database as $data)
			<img id="travellers" src="{{$data->profileUrl}}"></img>
			@endforeach
		</div>
		<div>
			<h3>Around the Web</h3>
			<div class="social"><ul>
				<li><a target="_blank" href="https://www.linkedin.com/in/keisuke-sato-15a601a0?trk=nav_responsive_tab_profile_pic" class="button social"><i class="fa fa-fw fa-linkedin"></i></a></li>
				<li><a target="_blank" href="https://github.com/ksato0607/Trippers" class="button social"><i class="fa fa-fw fa-github"></i></a></li>
				<li><a target="_blank" href="https://twitter.com/trip_go_trip" class="button social"><i class="fa fa-fw fa-twitter"></i></a></li>
			</ul>
			<!-- <div class="fb-like" data-href="http://phplaravel-31991-69079-187106.cloudwaysapps.com/" data-layout="standard" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div> -->
		</div>
	</div>
</div>
	<div id = "myModal" class = "modal">
	<div class = "modal-content">
		<p id = "disp"></p>
	</div>
	</div>
</footer>
<script>
function popupEmail(){
	document.getElementById("myModal").style.display = "block";
	document.getElementById("disp").innerHTML = '<form id="contactForm" style="background-color: #ff5722;" action="{{route('sendmail')}}" method="post"><div class="form-item"><input type="email" name="mail" placeholder="email address"></div><div class="form-item"><input type="text" name="name" placeholder="enter your name"></div><div class="form-item"><input type ="tel" name="phone" placeholder="phone number"></div><div class="form-item"><input type ="text" name="title" placeholder="email title"></div><div class="form-item"><textarea placeholder="Message" row="10" name ="body"></textarea></div><button type="submit" id="shareButton">Contact Us</button>{{ csrf_field() }} </br></br></form>';
}
</script>
@stop

@section('translate')
<style> .goog-te-banner-frame.skiptranslate{display:none!important;}body{top: 0px!important;} </style>
<div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
	new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<script>
// Find all  <input> placeholders
var inputPlaceholders = document.querySelectorAll('input[placeholder]');
//Find all <textarea> placeholders
var textareaPlaceholders = document.querySelectorAll('textarea[placeholder]');
//combine intput and textarea placeholders and convert placeholders to an array
var placeholders = Array.prototype.slice.call(inputPlaceholders).concat(Array.prototype.slice.call(textareaPlaceholders));
if (placeholders.length) {
	// copy placeholder text to a hidden div
	var div = $('<div id="placeholders" style="display:none;"></div>');
	placeholders.forEach(function(input){
		var text = input.placeholder;
		div.append('<div>' + text + '</div>');
	});
	$('body').append(div);

	// save the first placeholder in a closure
	var original = placeholders[0].placeholder;

	// check for changes and update as needed
	setInterval(function(){
		if (isTranslated()) {
			updatePlaceholders();
			original = placeholders[0].placeholder;
		}}, 500);
	function isTranslated() {  // true if translated
		var current = $($('#placeholders > div')[0]).text();
		return !(original == current);
	}
	function updatePlaceholders() {
		$('#placeholders > div').each(function(i, div){
			placeholders[i].placeholder = $(div).text();
		});
	}
}
</script>
@stop
