@extends('layouts.master')

@section('title')
TripTrip
@endsection

@section('content')
  @include('includes.message-block')
<div class="row">
  <div class="col-md-6">
  <h3>Sign Up</h3>
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
      </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <input type="hidden" name="_token" value="{{ Session::token() }}">
    </form>
  </div>

  <div class="col-md-6">
    <h3>Sign In</h3>
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
</div>
@endsection

<!-- <div>
<form action="{{route('sendmail')}}" method="post">
<input type="email" name="mail" placeholder="email address"><br>
<input type="text" name="name" placeholder="enter your name"><br>
<input type ="tel" name="phone" placeholder="phone number"><br>
<input type ="text" name="title" placeholder="email title"><br>
<textarea row="5" name ="body"></textarea><br>
<button type="submit">Contact Us</button>
{{ csrf_field() }}
</form>
</div> -->
