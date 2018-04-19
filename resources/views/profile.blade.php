@extends('layouts.profile')

@section('page-style')
    
    <link href="{{ asset('css/home.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet" type="text/css" >
    
@endsection

@section('content')

    @include('partials.nav')
        <div class="container">
            <div class="row">
                <div class="col-md-9">

                    <div class="content-header">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="col-md-3">
                                    <img src="../uploads/avatars/{{ Auth::user()->avatar }}" alt="Profile Picture of {{ Auth::user()->name }}">
                                    @if(Auth::user()->id == $users->id)
                                        <button class="btn btn-primary curve-edge main-button upload-btn" data-toggle="modal" data-target="#editAvatarModal">Edit Profile Picture</button>
                                    @endif
                                </div>
                                <div class="col-md-9">
                                    @if(Auth::user()->id == $users->id)
                                        <a data-toggle="modal" data-target="#editProfileModal" class="config-button"><i class="far fa-edit"></i></a>
                                    @endif
                                        <h3>{{ $users->name }}</h3>
                                        <h4><span>@</span>{{ $users->username }}</h4>
                                        <p>{{ $users->short_description }}</p>
                                        <div class="profile-buttons">
                                    @if(Auth::check())
                                        @if($is_add_question)
                                           <button data-toggle="modal" data-target="#addQuestionModal" class="btn btn-primary curve-edge main-button question-btn">Add Question</button>
                                        @else
                                            <button type="button" class="btn btn-primary curve-edge main-button question-btn" v-on:click="follows">@{{ followBtnText }}</button> 
                                        @endif
                                    @endif
                                              
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                   @foreach($questions as $question)
                       <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="col-md-3">
                                   <div class="row">
                                        <ul class="question-details">
                                            <li class="col-md-4">
                                                <div class="display-block">
                                                    <p class="light-weight">{{ $question->answer->count() }}</p>
                                                    <p><a href="#"><i class="far fa-comments"></i></a></p>
                                                </div>
                                            </li>
                                            <li class="col-md-4">
                                                <div class="display-block">
                                                    <p>{{$question->downvote}}</p>
                                                    <p><a href="#"><i class="fas fa-chevron-circle-up"></i></a></p>
                                                </div>
                                            </li>
                                            <li class="col-md-4">
                                                <div class="display-block">
                                                    <p>{{$question->downvote}}</p>
                                                    <p><a href="#"><i class="fas fa-chevron-circle-down"></i></a></p>
                                                </div>
                                            </li>
                                        </ul>
                                   </div>
                                </div>
                                <div class="question-set col-md-9">
                                    {{-- <div class="dropdown dropdown-position">
                                        <span id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></span>
                                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                                            <li><a href="#"><span><i class="fas fa-pen-square"></span></i>Edit</a></li>
                                            <li><a href="#"><span><i class="fas fa-trash-alt"></span></i>Delete</a></li>
                                        </ul>
                                    </div> --}}
                                    <h5><a href={{ url("question/$question->id" )}}>{{ $question->questions }}</a></h5>
                                    <p>Category: <a href="#">{{ $question->category->categories }}</a></p>
                                    <p><span> {{$question->created_at->diffForHumans()}}</span></p>
                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                   @endforeach
                </div>

                <div class="col-md-3">
                    
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h4 class="text-center">Feeds</h4>
                            <ol class="statistics">
                                <li><a href="profile/{{ Auth::user()->id }}">Questions </a><span>{{ $question_count }}</span></li>
                                <li><a href="/followers/{{ Auth::user()->username }}">Followers </a><span>{{ $followers_count }}</span></li>
                                <li><a href="/following">Following </a><span>{{ $following_count }}</span></li>
                                <li><a href="/following">Answers </a><span>{{ $following_count }}</span></li>
                            </ol>
                        </div>
                    </div>


                    <div class="panel panel-default users">
                        <div class="panel-body">
                            <h4 class="text-center">Other users</h4>
                                @foreach($random_users as $random_user)
                                    @if(Auth::id() != $random_user->id)
                                        <a href={{ url("profile/$random_user->id") }} style="margin-top: 20px;">
                                            <img src="../uploads/avatars/{{ $random_user->avatar }}" alt="Profile Picture of {{ $random_user->name }}" class="side-bar-profile-img">
                                            <h5>{{ $random_user->name }}</h5>
                                            <h6><span>@</span>{{ $random_user->username }}</h6>
                                        </a>
                                    @endif
                                @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Edit profile picture modal -->
    <div class="modal fade" id="editAvatarModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class="profile-logo"><i class="far fa-image"></i></span>Edit Profile Picture</h4>
                </div>
                <h4 class="text-center">Current Profile Picture</h4>
                <img src="../uploads/avatars/{{ Auth::user()->avatar }}" alt="Profile Picture of {{ Auth::user()->name }}" class="edit-profile-avatar">
                <form enctype="multipart/form-data" action="/profile/edit_picture" method="POST">
                    {{ csrf_field() }}
                    <input type="file" name="avatar" class="form-control" style="width: 80%; margin: 10px auto;">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary curve-edge main-button">Edit Profile Picture</button>
                        <button type="button" class="btn btn-default curve-edge" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('modals.add_question_modal')
    @include('modals.edit_profile_modal')

@endsection
