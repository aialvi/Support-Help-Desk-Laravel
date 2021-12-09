@extends('layouts.app')

@section('title', $ticket->title)

@section('content')
    <div class="row d-flex justify-content-center bg-white py-5 px-3 rounded-2">
        <div class="col-md-10 col-md-offset-1">
            <div class="row my-3">
                <div class="col-12">
                   <p> #ID: {{ $ticket->ticket_id }} </p>
                    <p> Title: {{ $ticket->title }} </p>
                </div>


                <div class="panel-body">
                    @include('includes.flash')

                    <div class="ticket-info">
                        <p>Details: {{ $ticket->message }}</p>
                        <p>Categry: {{ $category->name }}</p>
                        <p>
                            @if ($ticket->status === 'Open')
                                Status: <span class="label label-success">{{ $ticket->status }}</span>
                            @else
                                Status: <span class="label label-danger">{{ $ticket->status }}</span>
                            @endif
                        </p>
                        <p>Created on: {{ $ticket->created_at->diffForHumans() }}</p>
                    </div>

                    <hr>

                    <div class="comments my-2">
                        @foreach ($comments as $comment)
                            <div class="pt-3 panel-@if($ticket->user->id === $comment->user_id) {{"default"}}@else{{"success"}}@endif">
                                <div class="text-primary fw-bold">
                                    {{ $comment->user->name }}
                                    <span class="pull-right text-muted">{{ $comment->created_at->format('Y-m-d') }}</span>
                                </div>

                                <div class="panel panel-body">
                                    {{ $comment->comment }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="comment-form">
                        <form action="{{ url('comment') }}" method="POST" class="form">
                            {!! csrf_field() !!}

                            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                            <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                <textarea rows="4" id="comment" class="form-control" name="comment"></textarea>

                                @if ($errors->has('comment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group my-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
