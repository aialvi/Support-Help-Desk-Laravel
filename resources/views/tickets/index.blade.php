@extends('layouts.app')

@section('title', 'All Tickets')

@section('content')
    <div class="row row d-flex justify-content-center bg-white">
        <div class="col-10 col-offset-1">
            <div class="row pt-3 pb-4 my-5 rounded-3 border-dark">
                <div class="card-header mb-3">
                    <div class="col-10">
                        <b><i class="fas fa-ticket"> Tickets</i></b>
                    </div>
                </div>

                <div class="panel-body">
                    @if ($tickets->isEmpty())
                        <p>There are currently no tickets.</p>
                    @else
                        <table class="table">
                            <thead>
                            <tr>
                                <th>User</th>
                                <th>Category</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Last Updated</th>
                                <th style="text-align:center" colspan="2">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($tickets as $ticket)
                                <tr>
                                    <td>
                                        @foreach ($users as $user)
                                            @if ($user->id === $ticket->user_id)
                                                {{ $user->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($categories as $category)
                                            @if ($category->id === $ticket->category_id)
                                                {{ $category->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ url('tickets/'. $ticket->ticket_id) }}">
                                            {{ $ticket->title }}
                                        </a>
                                    </td>
                                    <td>
                                        @if ($ticket->status === 'Open')
                                            <span class="badge bg-success">{{ $ticket->status }}</span>
                                        @else
                                            <span class="badge bg-danger">{{ $ticket->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $ticket->updated_at }}</td>
                                    <td>
                                        <a href="{{ url('tickets/' . $ticket->ticket_id) }}" class="btn btn-primary">Comment</a>
                                    </td>
                                    <td>
                                        <form action="{{ url('admin/close_ticket/' . $ticket->ticket_id) }}" method="POST">
                                            {!! csrf_field() !!}
                                            <button type="submit" class="btn btn-danger">Close</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $tickets->render() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
