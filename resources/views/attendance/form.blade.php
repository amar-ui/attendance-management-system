@extends('layouts.master')

@section('title','Student')

@section('pageTitle', 'Attendance')

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
            <form action="{{ route('attendance.store') }}" method="post">
                @csrf

                <div class="card-body">

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Date</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="date" class="form-control" name="date" id="date" required
                                    placeholder="Date" {{-- value="2018-07-22" --}} @isset($edit)
                                    value="{{ date('Y-m-d', strtotime($edit->date)) }}" @endisset>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Department</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <select name="department_id" id="department_id" class="form-control course"
                                    data-style="select-with-transition" data-size="7">
                                    <option value="" selected disabled>Department</option>
                                    @foreach ($departments as $row)
                                    <option value="{{ $row->id }}" @if (isset($edit) && $edit->department_id ==
                                        $row->id) selected @endif>{{ ucfirst($row->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Semester</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <select name="semester" id="semester" class="form-control" required>
                                    <option value="" selected disabled>Semester</option>
                                    <option value="1" @if (isset($edit) && $edit->semester == 1) selected @endif>1at
                                        semester</option>
                                    <option value="2" @if (isset($edit) && $edit->semester == 2) selected @endif>2nd
                                        semester</option>
                                    <option value="3" @if (isset($edit) && $edit->semester == 3) selected @endif>3rd
                                        semester</option>
                                    <option value="4" @if (isset($edit) && $edit->semester == 4) selected @endif>4th
                                        semester</option>
                                    <option value="4" @if (isset($edit) && $edit->semester == 4) selected @endif>5th
                                        semester</option>
                                    <option value="4" @if (isset($edit) && $edit->semester == 4) selected @endif>6th
                                        semestst</option>
                                    <option value="4" @if (isset($edit) && $edit->semester == 4) selected @endif>7th
                                        semester</option>
                                    <option value="4" @if (isset($edit) && $edit->semester == 4) selected @endif>8th
                                        semester</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Subject</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <select name="subject_id" id="subject_id" class="form-control" required>
                                    <option value="" selected disabled>Subject</option>
                                    @foreach ($subjects as $row)
                                    <option value="{{ $row->id }}" @if (isset($edit) && $edit->subject_id ==
                                        $row->id) selected @endif>{{ ucfirst($row->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Absent List</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <select name="students[]" id="students" class="form-control"
                                    data-style="select-with-transition" data-size="7" multiple>
                                    {{-- <option value="" disabled>Enter Student Name seperate with Comma</option> --}}
                                    <option value="" disabled>Choose Department and Semester first</option>
                                    {{-- @foreach ($students as $row)
                                    <option value="{{ $row->id }}"
                                        @isset($edit)
                                            {{ ($edit->attendanceLog()->where('student_id', $row->id)->exists()) ? "selected" : "" }}
                                        @endisset>{{ $row->name }}</option>
                                    @endforeach --}}
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

                <div class="card-footer">
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
                                    Course
                                </th>
                                <th>
                                    Subject
                                </th>
                                <th>
                                    Teacher
                                </th>
                                <th>
                                    Dpartment
                                </th>
                                <th>
                                    Total Absenties
                                </th>
                                @if (Auth()->user()->type == 1 || Auth()->user()->id == $row->teacher_id)

                                <th class="text-right">
                                    Action
                                </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($data) > 0)

                            @foreach ($data as $row)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ ucfirst($row->department->name) }}</td>
                                <td>{{ ucfirst($row->subject->name) }}</td>
                                <td>{{ ucfirst($row->teacher->name) }}</td>
                                <td>{{ ($row->teacher_id == 1 ) ? 'Admin' : ucfirst($row->teacher->teacher->department->name) }}</td>
                                <td>{{ $row->attendanceLog->count() }}</td>
                                <td class="td-actions text-right">
                                    @if (Auth()->user()->type == 1 || Auth()->user()->id == $row->teacher_id)

                                    <a href="{{ route('attendance.edit', ['attendance'=>$row->id]) }}" rel="tooltip"
                                        class="btn btn-success btn-link" data-original-title="" title="">
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <button rel="tooltip" class="btn btn-danger btn-link" data-original-title=""
                                        title="" data-toggle="modal" data-name="{{ $row->name }}"
                                        data-id="{{ $row->id }}" data-target="#confirm-delete"
                                        data-href="{{ route('attendance.destroy', ['attendance'=>$row->id]) }}">
                                        <i class="material-icons">close</i>
                                    </button>
                                    @endif

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

@section('script')
    
<script>


    $('select').select2({
        theme: "classic"
    });

    $('#semester').change(function () {
        var course_id = $('#department_id').val();
        var semester = $(this).val();

        $('.js-data-example-ajax').select2({
            ajax: {
                url: "{{ route('autocomplete.subject-on-course-semester') }}",
                dataType: 'json',
                method: "POST",
                data: {
                    '_token': "{{ csrf_token() }}", 
                    course_id: course_id,
                    semester: semester
                },
                // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
            }
        });

        $.ajax({
            url: "{{ route('autocomplete.subject-on-course-semester') }}",
            method: "POST",
            data: {
                '_token': "{{ csrf_token() }}", 
                course_id: course_id,
                semester: semester
            },
            success: function (data) {
                var html = '<option selected disabled>Select Subject</option>';
                $(data['subject']).each(function (key,value) {
                    html += '<option value="'+value['id']+'">'+value['name']+'</option>';
                })

                $('#subject_id').html(html);
                // $('#subject_id').select2();

                html = '<option disabled>Select Subject</option>';

                $(data['students']).each(function (key,value) {
                    html += '<option value="'+value['studentId']+'">'+value['name']+'</option>';
                })

                console.log(html);
                $('#students').html(html);

            }
        })
    });
</script>
@endsection