@extends('layouts.app')

@section('title', 'My Tickets')

@section('content')

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <div class="row d-flex justify-content-center bg-white">
        <div class="col-md-10 col-md-offset-1">
            <div class="card">
                <div class="container my-3">
                    <div class="card-header col-12">
                        <i class="fa fa-ticket">My Tickets</i>
                    </div>
                </div>

                <div class="panel-body">
                    @if ($tickets->isEmpty())
                        <p>You have not created any tickets.</p>
                    @else
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Category</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Last Updated</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($tickets as $ticket)
                                <tr>
                                    <td>
                                        {{ $loop->index+1 }}
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
