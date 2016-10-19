@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <!-- Display Validation Errors -->
            

            <div class="panel panel-default">
                <div class="panel-heading">
                    Welcome to the Ritual
                </div>

                <div class="panel-body">

                    <p>
                        You recently bought anything from Rituals? Perform your own Ritual and maybe get some free RitualCurrency!
                    </p>
                    @if (!Auth::check())
                        <br />
                
                        <a href="{{ url('/login') }}">Perform your own ritual</a>
                    @endif
                
                </div>
            </div>

            @if (Auth::check())
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Welcome to the Ritual
                    </div>

                    <div class="panel-body">

                        <p>
                            You recently bought anything from Rituals? Perform your own Ritual and maybe get some free RitualCurrency!
                        </p>

                            <br />
                    
                        <a href="{{ url('/entry') }}">Perform your own ritual</a>
                    
                    </div>
                </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">
                    The Ritual Winners
                </div>
                <div class="panel-body">
                    
                    <ul class="winner-overview">
                        @foreach ($winners as $winner)
                            <li>
                                <div class="user">{{$winner->user_id}}</div>
                                <div class="period">{{$winner->period_id}}</div>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
