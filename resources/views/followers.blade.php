@extends('layouts.app')

@section('page-style')
    <style type="text/css">
        .col-md-2 {
            padding-right: 0;
        }

        .panel-body h2 {
            padding-top: -15px;
        }

    </style>

    
@endsection

@section('content')

@include('partials.nav')

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <h1 class="text-center">Followers</h1>
                @if($followers_count == 0)
                    <h4 class="text-center">You have no followers</h4>
                    <h4 class="text-center">Other users for this site</h4>
                    @foreach($random_users as $random_follower)                        
                        @if($random_follower->id != Auth::user()->id)
                            <div class="panel panel-default row">
                                <div class="panel-body">
                                    <div class="col-md-6 col-md-offset-3">
                                        <img src="../uploads/avatars/{{ $random_follower->avatar }}" alt="Profile Picture of {{ $random_follower->name }}" class="follower-profile-img">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-3">
                                            <h2 class="text-center"><a href={{ url("profile/$random_follower->id") }}>{{ $random_follower->name }}</a></h2>
                                            <h6 class="text-center"><span>@</span>{{ $random_follower->username }}</h6>
                                            <h4 class="text-center">{{ $random_follower->short_description }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <h4 class="text-center">You have {{ $followers_count }} followers</h4>
                @endif

                @foreach($list as $follower)
                    <div class="panel panel-default row">
                        <div class="panel-body">
                            <div class="col-md-6 col-md-offset-3">
                                <img src="../uploads/avatars/{{ $follower->avatar }}" alt="Profile Picture of {{ $follower->name }}" class="follower-profile-img">
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <h2 class="text-center"><a href={{ url("profile/$follower->id") }}>{{ $follower->name }}</a></h2>
                                    <h6 class="text-center"><span>@</span>{{ $follower->username }}</h6>
                                    <h4 class="text-center">{{ $follower->short_description }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                
                
            </div>
        </div>
    </div>



@endsection
