@extends('layouts.app')

@section('page-style')
    <link href="{{ asset('css/home.css') }}"rel="stylesheet" type="text/css">
@endsection

@section('content')

@include('partials.nav')
<div class="container">
    <div class="row">
        <div class="col-md-3">

            <div class="panel panel-default">
                <div class="panel-body">
                    <h4 class="text-center">Feeds</h4>
                    <ol class="statistics">
                        <li><a href="profile/{{ Auth::user()->id }}">Questions </a><span>{{ $question_count }}</span></li>
                        <li><a href="/followers/{{ Auth::user()->username }}">Followers </a><span>{{ $followers_count }}</span></li>
                        <li><a href="/following">Following </a><span>{{ $following_count }}</span></li>
                    </ol>
                </div>
            </div>

            @include('partials.category')
        </div>
        <div class="col-md-7">
            <div class="question-box row">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-1">
                            <img src="../uploads/avatars/{{ Auth::user()->avatar }}" alt="Profile Picture of {{ Auth::user()->name }}">
                        </div>
                        <div class="col-md-11">
                            <p>{{ Auth::user()->name }}</p>
                            <p><a href="" data-toggle="modal" data-target="#addQuestionModal">What is your question?</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                
                @foreach($all_questions as $question)
                    <div class="panel panel-default row">
                        <div class="panel-body">
                            <div class="col-md-3">
                               <div class="row">
                                    <ul class="question-details">
                                        <li class="col-md-4">
                                            <div class="display-block">
                                                <p class="light-weight">0</p>
                                                <p><a href="#"><i class="far fa-comments"></i></a></p>
                                            </div>
                                        </li>
                                        <li class="col-md-4">
                                            <div class="display-block">
                                                <p>{{ $question->upvote }}</p>
                                                <p><a href="#"><i class="fas fa-chevron-circle-up"></i></a></p>
                                            </div>
                                        </li>
                                        <li class="col-md-4">
                                            <div class="display-block">
                                                <p>{{ $question->downvote }}</p>
                                                <p><a href="#"><i class="fas fa-chevron-circle-down"></i></a></p>
                                            </div>
                                        </li>
                                    </ul>
                               </div>
                            </div>

                            <div class="question-set col-md-8">
                                <h5><a href={{ url("question/$question->id") }}>{{ $question->questions }}</a></h5>
                                <p>by: <a href={{ url("profile/$question->user_id") }}>{{ $question->user->name }}</a></p>
                                <p><span>{{ $question->created_at->diffForHumans() }}</span></p>
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
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-default users">
                <div class="panel-body">
                    <h4 class="text-center">Other users</h4>
                        @foreach($random_users as $random_user)
                            @if($random_user->id != Auth::user()->id)
                            <a href={{ url("profile/$random_user->id") }}>
                                <img src="../uploads/avatars/{{ $random_user->avatar }}" alt="Profile Picture of {{ Auth::user()->name }}" class="side-bar-profile-img">
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

@include('modals.add_question_modal')

@endsection
