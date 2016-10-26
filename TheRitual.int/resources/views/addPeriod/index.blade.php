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
                    Add Period
                </div>
                <div class="panel-body">
                    <form action="{{ url( 'period/create' ) }}" method="POST" class="form-horizontal">
                        {!! csrf_field() !!}

                        <!-- Period Name -->
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Name</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                        </div>

                        <!-- Period Start and End Date -->
                        <div class="form-group">
                            <label for="start_date" class="col-sm-3 control-label">Start date</label>

                            <div class="col-sm-6">
                                <input type="text" name="start_date" id="start_date" class="form-control" placeholder="2010-01-01 05:00:00">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="end_date" class="col-sm-3 control-label">End date</label>

                            <div class="col-sm-6">
                                <input type="text" name="end_date" id="end_date" class="form-control" placeholder="2016-12-12 20:20:20">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="code" class="col-sm-3 control-label">Code</label>

                            <div class="col-sm-6">
                                <input type="text" name="code" id="code" class="form-control" maxlength="10">
                            </div>
                        </div>

                        <!-- Add Entry Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-plus"></i> Add Period
                                </button>
                            </div>
                        </div>
                    </form>
                </div>    
            </div>
        </div>
    </div>
</div>
@endsection
