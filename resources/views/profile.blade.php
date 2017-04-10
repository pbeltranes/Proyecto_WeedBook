@extends('app')
@section('title')
{{ $user->name }}
@endsection
@section('content')
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container">
    <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey" title="close menu">
      <i class="fa fa-remove"></i>
    </a>
    <img src="{{$user_profile->avatar_url}}" style="width:45%;" class="w3-round"><br><br>
    <h4><b>About</b></h4>
    <p class="w3-text-grey">{{$user_profile->bio}}</p>
  </div>
</nav>
<div>
  <ul class="list-group">
    <li class="list-group-item">
      Joined on {{$user->created_at->format('M d,Y \a\t h:i a') }} <br>
      Growing Since {{$user_profile->growing_since}} <br>
      Birthdate {{$user_profile->birthdate}} <br>
    </li>
    <li class="list-group-item panel-body">
      <table class="table-padding">
        <style>
          .table-padding td{
            padding: 3px 8px;
          }
        </style>
        <tr>
          <td>Review Rep</td>
          <td> {{$prom_rev_rep}}</td>
       </tr>
       <tr>
         <td>Comment Rep</td>
         <td> {{$prom_comments_rep}}</td>
       </tr>
      </table>
    </li>
    <li class="list-group-item">
      
    </li>
    @if($profile_options)
    <a href="{{url('/user/'.Auth::id().'/edit')}}">Edit Profile</a>
    <a href="{{url('/user/delete/'.Auth::id().'')}}">DELETE PROFILE!</a>
    @endif
  </ul>
</div>
@endsection