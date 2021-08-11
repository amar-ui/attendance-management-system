@extends('layouts.master')

@section('title','Teacher')

@section('pageTitle', 'Teacher')

@section('content')

<div class="row">

    <div class="col-md-6">
        <div class="card ">
            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">assignment</i>
                </div>
                <h4 class="card-title ">Form</h4>
            </div>
            <form method="post"
                action="@isset($edit){{ route('teacher.update', ['teacher'=>$edit->id]) }} @else {{ route('teacher.store') }} @endif"
                class="form-horizontal">
                @csrf

                <div class="card-body ">

                    @isset($edit)
                    @method('PATCH')
                    <input type="hidden" name="edit" value="{{ $edit->id }}">
                    @endisset

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="txet" class="form-control" name="name" id="name" required
                                    placeholder="Department" @isset($edit) value="{{ $edit->name }}" @endif>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Department</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <select name="department_id" id="department_id" class="form-control" required>
                                    <option value="" selected disabled>Department Name</option>
                                    @foreach ($departments as $row)
                                    <option value="{{ $row->id }}" @if (isset($edit) && $edit->teacher->department_id ==
                                        $row->id) selected @endif>{{ ucfirst($row->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Subject</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <select name="subject_id" id="subject_id" class="form-control" required>
                                    <option value="" selected disabled>Subject Name</option>
                                    @foreach ($subjects as $row)
                                    <option value="{{ $row->id }}" @if (isset($edit) && $edit->teacher->subject_id ==
                                        $row->id) selected @endif>{{ ucfirst($row->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <label class="col-sm-2 col-form-label">Gender</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <select name="gender" id="gender" class="form-control" required>
                                    <option value="" selected disabled>Gender</option>
                                    <option  @if (isset($edit) && $edit->teacher->gender == 1) selected @endif value="1">Male</option>
                                    <option  @if (isset($edit) && $edit->teacher->gender == 2) selected @endif value="2">Female</option>
                                    <option  @if (isset($edit) && $edit->teacher->gender == 3) selected @endif value="3">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="number" class="form-control" name="phone" id="phone" required
                                    placeholder="Phone" @isset($edit) value="{{ $edit->teacher->phone }}" @endif>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Address" name="address"
                                    id="address" required>@isset($edit){{ $edit->teacher->address }} @endif</textarea>
                            </div>
                        </div>
                    </div>

                    @if(!isset($edit))

                    <hr>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="email" required
                                    placeholder="Email ID">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" id="password" required
                                    placeholder="Password">
                            </div>
                        </div>
                    </div>

                    @endif

                </div>

                <div class="card-footer ">
                    <button type="submit" class="btn btn-fill btn-rose">@isset($edit) Update @else Submit @endif<div
                            class="ripple-container"></div>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">list</i>
                </div>
                <h4 class="card-title ">List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatables" class="table">
                        <thead class="text-primary">
                            <tr>
                                <th>
                                    #.No
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Department
                                </th>
                                <th>
                                    Subject
                                </th>
                                <th class="text-right">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($data) > 0)

                            @foreach ($data as $row)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ ucfirst($row->name) }}</td>
                                <td>{{ ucfirst($row->teacher->department->name) }}</td>
                                <td>{{ ucfirst($row->teacher->subject->name) }}</td>
                                <td class="td-actions text-right">
                                    <a href="{{ route('teacher.edit', ['teacher'=>$row->id]) }}" rel="tooltip"
                                        class="btn btn-success btn-link" data-original-title="" title="">
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <button rel="tooltip" class="btn btn-danger btn-link" data-original-title=""
                                        title="" data-toggle="modal" data-name="{{ $row->name }}"
                                        data-id="{{ $row->id }}" data-target="#confirm-delete"
                                        data-href="{{ route('teacher.destroy', ['teacher'=>$row->id]) }}">
                                        <i class="material-icons">close</i>
                                    </button>

                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="3">No records</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection