@extends('layouts.app')

@section('page-style')
    <link href="{{ asset('css/general-style.css') }}"rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/question-page.css') }}"rel="stylesheet" type="text/css">
@endsection

@section('content')

@include('partials.nav')
<div class="container">
    <div class="row">

        <div class="col-md-7 col-md-offset-1">
            <div class="row">

                <div class="panel panel-default question">
                    <div class="panel-body">
                        <div class="col-md-2">
                            <img src="../uploads/avatars/{{ $question->user->avatar }}" alt="Profile Picture of {{ $question->user->name }}" class="question-profile-img">
                        </div>
                        <div class="col-md-10 main-question">
                            @if(Auth::user()->id == $question->user->id)
                                <div class="dropdown dropdown-position">
                                    <span id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></span>
                                    <ul class="dropdown-menu" aria-labelledby="dLabel">
                                        <li><a href="#" data-toggle="modal" data-target="#editQuestionModal"><span><i class="fas fa-pen-square"></span></i>Edit</a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#deleteQuestionModal"><span><i class="fas fa-trash-alt"></span></i>Delete</a></li>
                                    </ul>
                                </div>
                            @endif
                            <h2>{{ $question->questions }}</h2>
                            <h5>Category: {{ $question->category->categories }}</h5>
                            <p><a href={{url("profile/$question->user_id")}}>by: {{ $question->user->name }}</a></p>
                            <p>{{ $question->created_at->diffForHumans() }}</p>
                            @if($question->upvote == 0)
                                <button class="btn btn-default" id="upvote-question-{{ $question->id }}"><span class="btn-text"><i class="fas fa-chevron-circle-up"></i></span><span id="upvote-count"></span> Upvote</button>
                                <button class="btn btn-default" id="downvote-question-{{ $question->id }}"><span class="btn-text"><i class="fas fa-chevron-circle-down"></i><span id="upvote-count"></span></span> Downvote</button>
                            @else
                                <button class="btn btn-default" id="upvote-question-{{ $question->id }}"><span class="btn-text"><i class="fas fa-chevron-circle-up"></i></span><span id="upvote-count">{{ $question->upvote }}</span> Upvote</button>
                                <button class="btn btn-default" id="downvote-question-{{ $question->id }}"><span class="btn-text"><i class="fas fa-chevron-circle-down"></i></span><span id="downvote-count">{{ $question->downvote }}</span> Downvote</button>
                            @endif

                            @if(count($question->answer) > 0)
                                <hr>
                                    <p>{{ count($question->answer) }} answers</p>
                                <hr>    
                                @foreach($question->answer as $answer)
                                    <div class="row comment">
                                        <div class="col-md-1">
                                           <img src="../uploads/avatars/{{ $answer->user->avatar }}" alt="Profile Picture of {{ $answer->user->name }}" class="answer-profile-img">
                                        </div>
                                        <div class="col-md-11">
                                            <h5><a href="/profile/{{ $answer->user->id }}">{{ $answer->user->name }}</a></h5>
                                            <h4>{{ $answer->answers }}</h4>
                                            <p>{{ $answer->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                <hr>
                                @endforeach
                            @else
                                <hr>
                                    <p>No answer for this question</p>
                                <hr>
                            @endif
                            
                            <div class="row input-comment">
                                <div class="col-md-1">
                                   <img src="../uploads/avatars/{{ Auth::user()->avatar }}" alt="Profile Picture of {{ Auth::user()->name }}" class="answer-profile-img">
                                </div>
                                <form method="POST" action={{ url("/question/{$question->id}/answer") }}>
                                    {{ csrf_field() }}
                                    <div class="col-md-8">
                                        <textarea class="form-control" name="answer"></textarea>
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-primary curve-edge" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 side-questions panel panel-default">
            <div class="panel-body">
                <h4>Other questions</h4>
                <ul>
                    @foreach($random_questions as $random_question)
                        <li><a href={{ url("question/$random_question->id") }}>{{ $random_question->questions }}</a><p>by: <span>{{ $random_question->user->name }}</span></p></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Edit question Modal -->
<div class="modal fade" id="editQuestionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><span class="profile-logo"><i class="fas fa-comment-dots"></i></span>Edit Question</h4>
            </div>
            <form method="POST" action={{ url("/question/$question->id/edit") }}>
                {{ csrf_field() }}
                <div class="modal-body">
                    <label>Category</label>
                    <select name="category" class="form-control curve-edge">
                       <option value="8" selected>General</option>
                       <option value="1">Weird</option>
                       <option value="2">Dumb</option>
                       <option value="3">Science</option>
                       <option value="4">Technology</option>
                       <option value="5">Arts</option>
                       <option value="6">History</option>
                       <option value="7">Funny</option>
                    </select>
                    <textarea class="form-control short-text" placeholder="Start your question with &quot;What&quot;, &quot;How&quot;, &quot;Why&quot;, etc." name="question">{{ $question->questions }}</textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary curve-edge main-button">Edit</button>
                    <button type="button" class="btn btn-default curve-edge" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete question Modal -->
<div class="modal fade" id="deleteQuestionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><span class="profile-logo"><i class="fas fa-comment-dots"></i></span>Delete Question</h4>
            </div>
            <form method="POST" action={{ url("/question/$question->id/delete") }}>
                {{ csrf_field() }}
                {{ method_field('delete') }}
                <div class="modal-body">
                    <p>Are you sure you want to delete this question?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary curve-edge main-button">Delete</button>
                    <button type="button" class="btn btn-default curve-edge" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection


@section('script')

    <script type="text/javascript">

        $('#upvote-question-{{$question->id}}').click(function(){
            var count = $('#upvote-count').val();
            if(count === ""){
                count = 0;
            }
            var questionId = {{ $question->id }};
            var userId = {{ Auth::user()->id }};
            $.post('/question/upvote' ,
                { count: count, 
                  question_id: questionId,
                  user_id: userId,
                  _token: "{{ csrf_token() }}" },
                function(data, status) {
                    console.log(data.upvote);
                    // $('#upvote-count').text('');
                    // $('#upvote-count').text( data.upvote );
                });
        });

        $('#downvote-question-{{$question->id}}').click(function(){
            var count = $('#downvote-count').val();
            if(count === ""){
                count = 0;
            }
            var questionId = {{ $question->id }};
            var userId = {{ Auth::user()->id }};
            $.post('/question/downvote' ,
                { count: count, 
                  question_id: questionId,
                  user_id: userId,
                  _token: "{{ csrf_token() }}" },
                function(data, status) {
                    console.log(data.downvote);
                    $('#downvote-count').text('');
                    $('#downvote-count').text( data.downvote );
                });
        });

    </script>
@endsection
