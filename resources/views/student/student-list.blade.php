@extends('layouts.master')

@section('title','Student')

@section('pageTitle', 'Student')

@section('content')

<div class="row">

    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">assignment</i>
                </div>
                <h4 class="card-title ">Filter</h4>
            </div>
            <form method="get" class="form-horizontal" action="{{ route('report.student-list') }}">
                <div class="card-body ">

                    <div class="row">

                        <label class="col-sm-2 col-form-label">Department</label>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <select name="department_id" id="department_id" class="form-control" required>
                                    <option value="" selected disabled>Department Name</option>
                                    @foreach ($department as $row)
                                    <option value="{{ $row->id }}" {{ (request('department_id') == $row->id) ? "selected" : "" }}>{{ ucfirst($row->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <select name="semester" id="semester" class="form-control" required>
                                    <option value="" selected disabled>Select Year</option>
                                    <option value="1" {{ (request('semester') == 1) ? "selected" : "" }}>1st semester</option>
                                    <option value="2" {{ (request('semester') == 2) ? "selected" : "" }}>2nd semester</option>
                                    <option value="3" {{ (request('semester') == 3) ? "selected" : "" }}>3rd semester</option>
                                    <option value="4" {{ (request('semester') == 4) ? "selected" : "" }}>4th semester</option>
                                    <option value="5" {{ (request('semester') == 5) ? "selected" : "" }}>5th semester</option>
                                    <option value="6" {{ (request('semester') == 6) ? "selected" : "" }}>6th semestst</option>
                                    <option value="7" {{ (request('semester') == 7) ? "selected" : "" }}>7th semester</option>
                                    <option value="8" {{ (request('semester') == 8) ? "selected" : "" }}>8th semester</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer row">
                    {{-- <button type="submit" class="btn btn-fill btn-rose">Filter<div class="ripple-container"></div>
                    </button> --}}

                </div>
                <div>
                    <button type="submit" name="submit" value="0" class="btn btn-fill btn-rose">Filter<div class="ripple-container"></div>
                    </button>
                    <button type="submit" name="submit" value="1" class="btn btn-fill btn-success">Excel<div class="ripple-container"></div>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">list</i>
                </div>
                <h4 class="card-title ">List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    
                    @include('student.student-list-table')

                </div>
            </div>
        </div>
    </div>

</div>

@endsection