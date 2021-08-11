@extends('layouts.master')

@section('title','Course')

@section('pageTitle', 'Department')

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
                action="@isset($edit){{ route('department.update', ['department'=>$edit->id]) }} @else {{ route('department.store') }} @endif"
                class="form-horizontal">
                @csrf

                <div class="card-body ">

                    @isset($edit)
                    @method('PATCH')
                    <input type="hidden" name="edit" value="{{ $edit->id }}">
                    @endisset

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Department Name</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="txet" class="form-control" name="name" id="name" required
                                    placeholder="Department" @isset($edit) value="{{ $edit->name }}" @endif>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Semester</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="txet" class="form-control" name="semester[]" id="semester" required readonly
                                    placeholder="Semester" value="1">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Subjects</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <select name="subject_id[0][]" class="form-control" multiple required>
                                    <option value="" disabled>Choose Subjects</option>
                                    @foreach ($subjects as $row)
                                    <option value="{{ $row->id }}" @if (isset($edit) == $row->id) selected @endif>{{ ucfirst($row->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Semester</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="txet" class="form-control" name="semester[]" id="semester" required readonly
                                    placeholder="Semester" value="2">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Subjects</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <select name="subject_id[1][]" class="form-control" multiple required>
                                    <option value="" disabled>Choose Subjects</option>
                                    @foreach ($subjects as $row)
                                    <option value="{{ $row->id }}" @if (isset($edit) && $edit->department_id ==
                                        $row->id) selected @endif>{{ ucfirst($row->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Semester</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="txet" class="form-control" name="semester[]" id="semester" required readonly
                                    placeholder="Semester" value="3">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Subjects</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <select name="subject_id[2][]" class="form-control" multiple required>
                                    <option value="" disabled>Choose Subjects</option>
                                    @foreach ($subjects as $row)
                                    <option value="{{ $row->id }}" @if (isset($edit) && $edit->department_id ==
                                        $row->id) selected @endif>{{ ucfirst($row->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Semester</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="txet" class="form-control" name="semester[]" id="semester" required readonly
                                    placeholder="Semester" value="4">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Subjects</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <select name="subject_id[3][]" class="form-control" multiple required>
                                    <option value="" disabled>Choose Subjects</option>
                                    @foreach ($subjects as $row)
                                    <option value="{{ $row->id }}" @if (isset($edit) && $edit->department_id ==
                                        $row->id) selected @endif>{{ ucfirst($row->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Semester</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="txet" class="form-control" name="semester[]" id="semester" required readonly
                                    placeholder="Semester" value="5">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Subjects</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <select name="subject_id[4][]" class="form-control" multiple required>
                                    <option value="" disabled>Choose Subjects</option>
                                    @foreach ($subjects as $row)
                                    <option value="{{ $row->id }}" @if (isset($edit) && $edit->department_id ==
                                        $row->id) selected @endif>{{ ucfirst($row->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Semester</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="txet" class="form-control" name="semester[]" id="semester" required readonly
                                    placeholder="Semester" value="6">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Subjects</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <select name="subject_id[5][]" class="form-control" multiple required>
                                    <option value="" disabled>Choose Subjects</option>
                                    @foreach ($subjects as $row)
                                    <option value="{{ $row->id }}" @if (isset($edit) && $edit->department_id ==
                                        $row->id) selected @endif>{{ ucfirst($row->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Semester</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="txet" class="form-control" name="semester[]" id="semester" required readonly
                                    placeholder="Semester" value="7">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Subjects</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <select name="subject_id[6][]" class="form-control" multiple required>
                                    <option value="" disabled>Choose Subjects</option>
                                    @foreach ($subjects as $row)
                                    <option value="{{ $row->id }}" @if (isset($edit) && $edit->department_id ==
                                        $row->id) selected @endif>{{ ucfirst($row->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Semester</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="txet" class="form-control" name="semester[]" id="semester" required readonly
                                    placeholder="Semester" value="8">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Subjects</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <select name="subject_id[7][]" class="form-control" multiple required>
                                    <option value="" disabled>Choose Subjects</option>
                                    @foreach ($subjects as $row)
                                    <option value="{{ $row->id }}" @if (isset($edit) && $edit->department_id ==
                                        $row->id) selected @endif>{{ ucfirst($row->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Description" name="description"
                                    id="description">@isset($edit){{ $edit->description }} @endif</textarea>
                            </div>
                        </div>
                    </div>
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
                                    Department Name
                                </th>
                                <th>
                                    Description
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
                                <td>{{ ucfirst($row->description) }}</td>
                                <td class="td-actions text-right">
                                    {{-- <a href="#" rel="tooltip" class="btn btn-info btn-link" data-original-title="" title="">
                                          <i class="material-icons">person</i>
                                        <div class="ripple-container"></div></a> --}}
                                    {{-- <a href="{{ route('course.edit', ['course'=>$row->id]) }}" rel="tooltip"
                                        class="btn btn-success btn-link" data-original-title="" title="">
                                        <i class="material-icons">edit</i>
                                    </a> --}}
                                    <button rel="tooltip" class="btn btn-danger btn-link" data-original-title=""
                                        title="" data-toggle="modal" data-name="{{ $row->name }}"
                                        data-id="{{ $row->id }}" data-target="#confirm-delete"
                                        data-href="{{ route('department.destroy', ['department'=>$row->id]) }}">
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