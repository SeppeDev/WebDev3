@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <!-- Display Validation Errors -->
            @include('common.errors')
            @include('common.success')

            <div class="panel panel-default">
                <div class="panel-heading">
                    DASHBOARD
                </div>

            <!--    <div class="panel-body">

                    <p>
                        Here you can check
                        <ul>
                            <li>All users</li>
                            <li>All entries</li>
                            <li>All periods</li>
                        </ul>
                    </p>
                </div> -->
            </div>

<!--Users--> 
            <div class="panel panel-default">
                <a data-toggle="collapse" data-target="#users"><div class="panel-heading">
                    Users
                </div></a>
                <div class="panel-body collapse" id="users">
                    <div class="pull-right">
                        <form action="{{ url('user/excel') }}" method="GET">
                            <button>Get Excel</button>
                        </form>
                    </div>

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
                                <tr @if ($user->deleted_at != NULL) class="danger" @endif>
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
                                            <form action="{{ url('user/update/'.$user->id) }}" method="POST">
                                                {!! csrf_field() !!}

                                                <button @if ($user->deleted_at != NULL) disabled title="You can't demote a deleted admin." @endif>Demote</button>
                                            </form>
                                        @else
                                            <form action="{{ url('user/update/'.$user->id) }}" method="POST">
                                                {!! csrf_field() !!}

                                                <button @if ($user->deleted_at != NULL) disabled title="You can't promote a deleted user." @endif>Promote</button>
                                            </form>
                                        @endif</td>
    <!-- Delete/Restore Button -->  <td>
                                        @if ($user->deleted_at == NULL)
                                            <form action="{{ url('user/'.$user->id) }}" method="POST">
                                                {!! csrf_field() !!}
                                                {!! method_field('DELETE') !!}

                                                <button @if ($user->isAdmin) disabled title="You can't delete administrators." @endif>Delete</button>
                                            </form>
                                        @else
                                            <form action="{{ url('user/restore/'.$user->id) }}" method="POST">
                                                {!! csrf_field() !!}

                                                <button>Restore</button>
                                            </form>
                                        @endif </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

<!--Entries-->            
            <div class="panel panel-default">
                <a data-toggle="collapse" data-target="#entries"><div class="panel-heading">
                    Entries
                </div></a>
                <div class="panel-body collapse" id="entries">
                    <div class="pull-right">
                        <form action="{{ url('entry/excel') }}" method="GET">
                            <button>Get Excel</button>
                        </form>
                    </div>

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
                                <th>
                                    Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($entries as $entry)
                                <tr @if ($entry->deleted_at != NULL) class="danger" @elseif ($entry->period->deleted_at != NULL) class="warning" @elseif ($entry->user->deleted_at != NULL) class="info" @endif>
                                    <td>
                                        {{$entry->code}}</td>
                                    <td>
                                        {{$entry->period->name}}</td>
                                    <td>
                                        {{$entry->user->email}}</td>
                                    <td>
                                        {{$entry->ip}}</td>
    <!-- Delete/Restore Button -->  <td>
                                        @if ($entry->deleted_at == NULL)
                                            <form action="{{ url('entry/'.$entry->id) }}" method="POST">
                                                {!! csrf_field() !!}
                                                {!! method_field('DELETE') !!}

                                                <button>Delete</button>
                                            </form>
                                        @else
                                            <form action="{{ url('entry/restore/'.$entry->id) }}" method="POST">
                                                {!! csrf_field() !!}

                                                <button>Restore</button>
                                            </form>
                                        @endif </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

<!--Periods-->            
            <div class="panel panel-default">
                <a data-toggle="collapse" data-target="#periods">
                    <div class="panel-heading">
                        <div>
                            Periods
                        </div>
                    </div>
                </a>
                <div class="panel-body collapse" id="periods">
                    <div class="pull-right">
                        <form action="{{ url('period/add') }}" method="GET">
                            <button>Add Period</button>
                        </form>
                        <form action="{{ url('period/excel') }}" method="GET">
                            <button>Get Excel</button>
                        </form>
                    </div>

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
                                <th>
                                    Excel</th>
                                <th>
                                    Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($periods as $period)
                                <tr @if ($period->deleted_at != NULL) class="danger" @endif>
                                    <td>
                                        {{$period->name}}</td>
                                    <td>
                                        {{$period->code}}</td>
                                    <td>
                                        {{$period->start_date}}</td>
                                    <td>
                                        {{$period->end_date}}</td>
                                    <td>
                                        <form action="{{ url('period/excel/'.$period->id) }}" method="GET">
                                            <button>Get Excel</button>
                                        </form>
                                        </td>
    <!-- Delete/Restore Button -->  <td>
                                        @if ($period->deleted_at == NULL)
                                            <form action="{{ url('period/'.$period->id) }}" method="POST">
                                                {!! csrf_field() !!}
                                                {!! method_field('DELETE') !!}

                                                <button>Delete</button>
                                            </form>
                                        @else
                                            <form action="{{ url('period/restore/'.$period->id) }}" method="POST">
                                                {!! csrf_field() !!}

                                                <button>Restore</button>
                                            </form>
                                        @endif </td>
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
