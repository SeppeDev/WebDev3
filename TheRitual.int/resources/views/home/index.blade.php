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

            @if (Auth::check() && !Auth::user()->isAdmin)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Welcome to the Ritual
                    </div>

                    <div class="panel-body">
                        <!-- New Entry Form -->
                        <form action="{{ url( 'entry' ) }}" method="POST" class="form-horizontal">
                            {!! csrf_field() !!}

                            <!-- Todo Name -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Period</label>

                                <label class="col-sm-6 control-label">{{$currentPeriod->name}}</label>
                            </div>
                            <div class="form-group">
                                <label for="code" class="col-sm-3 control-label">Code</label>

                                <div class="col-sm-6">
                                    <input type="text" name="code" id="code" class="form-control">
                                </div>
                            </div>

                            <!-- Add Todo Button -->
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-plus"></i> Perform your own ritual
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>

                    @foreach ($periods as $period)
                        <div class="panel-heading">
                            <h3>{{$period->name}}</h3>
                        </div>

                        <div class="panel-body">
                            <ul class="winner-overview">

                            @foreach ($entries as $entry)
                                @if ($period->id == $entry->period_id)
                                        <li>
                                            {{$entry->code}}
                                        </li>
                                @endif
                            @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">
                    The Ritual Winners
                </div>
                <div class="panel-body">
                    @foreach ($periods as $period)
                        <h3>{{$period->name}}</h3>

                        @foreach ($winners as $winner)
                            @if ($period->id == $winner->period_id)
                                <ul class="winner-overview">
                                    <li>
                                        <div class="user">{{$winner->user->name}} from {{$winner->user->city}}, {{$winner->user->country}}</div>
                                    </li>
                                </ul>
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
