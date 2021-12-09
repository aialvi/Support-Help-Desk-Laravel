@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center bg-white">
            <div class="col-md-10 col-md-offset-1">
                <div class="card my-3">
                    <div class="card-header">Dashboard</div>

                    <div class="container p-3">


                        @if (\Auth::user()->is_admin)
                            <p>
                                See all <a href="{{ url('admin/tickets') }}">tickets</a>
                            </p>
                        @else
                            <p>
                                See all your <a href="{{ url('my_tickets') }}">tickets</a> or <a href="{{ url('new_ticket') }}">open new ticket</a>
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
