@extends('layout')

@section('header')
<li><a href="#map" class="scrollable">Map</a></li>
<li><a href="#portfolio" class="scrollable">New</a></li>
<li><a href="#contact" class="scrollable">Share</a></li>
<li><a href="{{ route('logout') }}">Logout</a></li>

<!-- end header-->
@stop

<!-- Adding Top Image-->
@section('topImage')
<img id="topImage" src="https://firebasestorage.googleapis.com/v0/b/laravel-659e1.appspot.com/o/pexels-photo-109917.jpeg?alt=media&token=66bdd20e-7ed5-4341-af16-b5da5119f7d6"/>
<p id="quote">If you can go anywhere, where would you like to go?</>
<a id="startJourney" href="#map" class="scrollable">Start your journey here</a>
@stop

<!-- Adding Map -->
@section('map')
<div id="floating-panel"></div>
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
  document.getElementById("floating-panel").innerHTML = totalTravellers + " Travellers Visited ";

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
            popupImage(url,story);
      });
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}

function attachLocation(marker, url, address) {
  var infowindow = new google.maps.InfoWindow({
    content: "<img src=" + url + " width=150px> " + "<br/>"+ address
    //disableAutoPan: true
  });

  marker.addListener('mouseover', function() {
    infowindow.open(marker.get('map'), marker);
  });

  marker.addListener('mouseout', function() {
    infowindow.close(marker.get('map'), marker);
  });
}

var modal = document.getElementById("myModal");
function popupImage(url,story){
    modal.style.display = "block";
    document.getElementById("disp").innerHTML = "<center> <img src=" + url + " width=80%><br/><br/>"
    + story + "</center>";
}

window.onclick = function(event)
{
	if(event.target == modal)
	{
		modal.style.display = "none";
	}
}

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoCNaVtm5v0u6cQ5FOxBBhkSIQ0LiZJXc&callback=initMap"
async defer></script>
<script type="text/javascript">

</script>
@stop

@section('new')
<section id="portfolio">
	<br/>
  <h2>New Location</h2>
  <ul class="grid">
    @foreach ($database as $data)
      <li><img src="{{ $data->imageUrl }}" alt="image not available"><font color="#666"> {{$data->imageStory}} </br>-{{$data->imageLocation}} </font></li>
  @endforeach
  </ul>
</section>
@stop

@section('share')
<section id="contact"  style="background-color:#1e1e1e;">
    <br/>
    <h2 style="color:#fff">Share Your Travel Experience</h2>
    <hr class="style-white"/>
      <div class="container">
      <div class="panel panel-primary">
      <div class="panel-body">

        <div class="alert alert-danger" id="validationFail">
          <strong>Whoops!</strong> There were some problems with your input.
        </div>

        <div class="alert alert-success alert-block" id="validationSuccess">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>Image Uploaded successfully.</strong>
        </div>

      <form id="contactForm" novalidate="" action="{{ url('/#contact') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-item">
          <label for="“name”">Username</label>
          <input id="name" type="text" placeholder="Username" style ="color:#d2d2d2" required/>
        </div>
        <div class="form-item">
          <input id="location" rows="5" placeholder="Location" style ="color:#d2d2d2" required/></input>
        </div>
        <div class="form-item">
          <textarea id="message" rows="5" placeholder="Your Travel Story" style ="color:#d2d2d2" required/></textarea>
        </div>
        <input type="file" value="upload" id="fileButton"/></br>
        </br>
        <input type="button" value="Share!" id="shareButton"/></br>
      </br>
      </form>
			<div id="form_text">
				<!-- <p style ="color:rgba(255, 152, 0, 0.73)">
					<strong> Do you like travelling? </br> Do you have some cool pictures? </br> Share your story to the world! </strong>
				</p> -->
			</div>
    </div>
  </div>
</div>
  </br>
  </section>
  <script src="https://www.gstatic.com/firebasejs/3.5.3/firebase.js"></script>
  <script>
  if(localStorage.validationSuccess=="TRUE"){
    document.getElementById('validationSuccess').style.display = "block";
    localStorage.setItem("validationSuccess", "FALSE");
  }
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
  var shareButton = document.getElementById('shareButton');

  fileButton.addEventListener('change',function(e){
    shareButton.addEventListener('click',function(){
      if(imageValidate()){
      var file = e.target.files[0];
      var storageRef = firebase.storage().ref(file.name);
      var message = document.getElementById('message').value;
      var imageLocation = document.getElementById('location').value;
      storageRef.put(file);
      storageRef.getDownloadURL().then(function(url) {
        var imageUrl = url;
        $.get("/test?url=" + imageUrl + '&message='+message + '&location=' + imageLocation);
        localStorage.setItem("validationSuccess", "TRUE");
        location.reload(); //To update database on our web
      });
    }
    });
  });

      function imageValidate(){
        var image = document.getElementById('fileButton');
        var imageUploadPath = image.value;

        //To check if user upload any file
        if (imageUploadPath != '') {
          var extension = imageUploadPath.substring(
            imageUploadPath.lastIndexOf('.') + 1).toLowerCase();

            //The file uploaded is an image
            if (extension == "gif" || extension == "png" || extension == "bmp"
            || extension == "jpeg" || extension == "jpg") {
              document.getElementById('validationSuccess').style.display = "block";
              document.getElementById('validationFail').style.display = "none";
              return true;
            }
            //The file upload is NOT an image
            else {
              document.getElementById('validationFail').style.display = "block";
              document.getElementById('validationSuccess').style.display = "none";
              return false;
            }
          }
        }
</SCRIPT>
  </script>
@stop

@section('feedback')
<section class="row new-post">
  <div class="col-md-6 col-md-offset-3">
  </br>
    <header><h3>We would like to improve our website! Your voice will be helpful!!</h3></header>
  </div>
  <center>
    <form action="{{ route('post.create') }}" method="post">
      <div class="form-group">
        <textarea class="form-control" name="body" id="new-post" rows="5" placeholder="type message here..."></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Post</button>
    </br></br>
      <input type="hidden" value="{{ Session::token() }}" name="_token">
    </form>
  </center>
  <div class="col-md-6 col-md-3-offset">
    @foreach($posts as $post)
      <article class="post" data-postid="{{ $post->id }}">
        <p style="color: #000">{{ $post->body }}</p>
        <div class="info">
          Posted by {{ $post->user->first_name }} on {{ $post->created_at }}
        </div>
        <div class="interaction">
          @if(Auth::user() == $post->user)
            <a href="#" class="edit">Edit</a> |
            <a href="{{ route('post.delete', ['post_id' => $post->id]) }}">Delete</a>
          @endif
        </div>
      </article>
    @endforeach
  </div>
</section>

<div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">Edit Post</h4>
    </div>
    <div class="modal-body">
      <form>
        <div class="form-group">
          <label for="post-body">Edit</label>
          <textarea class="form-control" name="post-body" id="post-body"></textarea>
        </div>
      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
    </div>
  </div>
</div>
</div>

<script>
var token = '{{ Session::token() }}';
var url = '{{ route('edit') }}';
</script>
@stop

@section('footer')
<!-- Footer-->
<footer>
  <div id="footer-above">
		<div>
		<h3>Would you like to give us feedback? <a onclick="popupEmail()">Email Us</a></h3>
		</div>
		<div>
      <h3>Travellers</h3>
			<img id="travellers" src="https://firebasestorage.googleapis.com/v0/b/laravel-659e1.appspot.com/o/10525892_690031424377754_5873567534962833692_n.jpg?alt=media&token=4567c703-7ca5-402d-a714-9db71049ec61"></img>
    </div>
    <div>
      <h3>Around the Web</h3>
      <div class="social"><ul>
        <li><a target="_blank" href="https://www.linkedin.com/in/keisuke-sato-15a601a0?trk=nav_responsive_tab_profile_pic" class="button social"><i class="fa fa-fw fa-linkedin"></i></a></li>
        <li><a target="_blank" href="https://github.com/ksato0607/309Laravel" class="button social"><i class="fa fa-fw fa-github"></i></a></li>
        <li><a target="_blank" href="https://twitter.com/trip_go_trip" class="button social"><i class="fa fa-fw fa-twitter"></i></a></li>
      </ul>
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
	document.getElementById("disp").innerHTML = '<form id="contactForm" action="{{route('sendmail')}}" method="post"><div class="form-item"><input type="email" name="mail" placeholder="email address"></div><div class="form-item"><input type="text" name="name" placeholder="enter your name"></div><div class="form-item"><input type ="tel" name="phone" placeholder="phone number"></div><div class="form-item"><input type ="text" name="title" placeholder="email title"></div><div class="form-item"><textarea placeholder="Message" row="10" name ="body"></textarea></div><button type="submit">Contact Us</button>{{ csrf_field() }}</form>';
}
</script>
@stop
