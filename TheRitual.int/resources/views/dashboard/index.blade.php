@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <!-- Display Validation Errors -->
            

            <div class="panel panel-default">
                <div class="panel-heading">
                    DASHBOARD
                </div>

                <div class="panel-body">

                    <p>
                        Here you can check
                        <ul>
                            <li><button data-toggle="collapse" data-target="#users">All users</button></li>
                            <li><button data-toggle="collapse" data-target="#entries">All entries</button></li>
                            <li><button data-toggle="collapse" data-target="#periods">All periods</button></li>
                        </ul>
                    </p>
                </div>
            </div>

<!--Users--> 
            <div class="panel panel-default">
                <div class="panel-heading">
                    Users
                </div>
                <div class="panel-body collapse" id="users">
                    <table id="users-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>
                                    Name</th>
                                <th>
                                    email</th>
                                <th>
                                    Address</th>
                                <th>
                                    Admin</th>
                                <th>
                                    Change admin</th>
                                <th>
                                    Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        {{$user->name}}</td>
                                    <td>
                                        {{$user->email}}</td>
                                    <td>
                                        {{$user->address}}, {{$user->postal_code}} {{$user->city}}, {{$user->country}}</td>
                                    <td>
                                        @if($user->isAdmin)
                                            YES
                                        @else
                                            NO
                                        @endif</td>
                                    <td>
                                        @if($user->isAdmin)
                                            Remove admin
                                        @else
                                            Make admin
                                        @endif</td>
        <!-- Delete Button -->      <td>
                                        <form action="{{ url('user/'.$user->id) }}" method="POST">
                                            {!! csrf_field() !!}
                                            {!! method_field('DELETE') !!}

                                            <button @if ($user->isAdmin) disabled title="You can't delete administrators." @endif>Delete</button>
                                        </form></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

<!--Entries-->            
            <div class="panel panel-default">
                <div class="panel-heading">
                    Entries
                </div>
                <div class="panel-body collapse" id="entries">
                    <table id="entries-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>
                                    Code</th>
                                <th>
                                    Period</th>
                                <th>
                                    User</th>
                                <th>
                                    IP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($entries as $entry)
                                <tr>
                                    <td>
                                        {{$entry->code}}</td>
                                    <td>
                                        {{$entry->period->name}}</td>
                                    <td>
                                        {{$entry->user->email}}</td>
                                    <td>
                                        {{$entry->ip}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

<!--Periods-->            
            <div class="panel panel-default">
                <div class="panel-heading">
                    Periods
                </div>
                <div class="panel-body collapse" id="periods">
                    <table id="periods-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>
                                    Name</th>
                                <th>
                                    Code</th>
                                <th>
                                    Startdate</th>
                                <th>
                                    Enddate</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($periods as $period)
                                <tr>
                                    <td>
                                        {{$period->name}}</td>
                                    <td>
                                        {{$period->code}}</td>
                                    <td>
                                        {{$period->start_date}}</td>
                                    <td>
                                        {{$period->end_date}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
