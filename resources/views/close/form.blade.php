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
            <form action="{{ route('close.store') }}" method="post">
                @csrf

                <div class="card-body">

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="text" class="form-control" name="title" id="title" required
                                    placeholder="Title" @isset($edit) value="{{ $edit->title }}" @endisset>
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
                                    <option value="1" @if (isset($edit) && $edit->semester == 1) selected @endif>1st
                                        semester</option>
                                    <option value="2" @if (isset($edit) && $edit->semester == 2) selected @endif>2nd
                                        semester</option>
                                    <option value="3" @if (isset($edit) && $edit->semester == 3) selected @endif>3rd
                                        semester</option>
                                    <option value="4" @if (isset($edit) && $edit->semester == 4) selected @endif>4th
                                        semester</option>
                                    <option value="5" @if (isset($edit) && $edit->semester == 5) selected @endif>5th
                                        semester</option>
                                    <option value="6" @if (isset($edit) && $edit->semester == 6) selected @endif>6th
                                        semestst</option>
                                    <option value="7" @if (isset($edit) && $edit->semester == 7) selected @endif>7th
                                        semester</option>
                                    <option value="8" @if (isset($edit) && $edit->semester == 8) selected @endif>8th
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

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Date from</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="date" class="form-control" name="date_from" id="date_from" required
                                    placeholder="Date From" @isset($edit)
                                    value="{{ date('Y-m-d', strtotime($edit->date_from)) }}" @endisset>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Date to</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="date" class="form-control" name="date_to" id="date_to" required
                                    placeholder="Date" @isset($edit)
                                    value="{{ date('Y-m-d', strtotime($edit->date_to)) }}" @endisset>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Total working days</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="number" class="form-control" name="total_working_days"
                                    id="total_working_days" required placeholder="Total working days" @isset($edit)
                                    value="{{ $edit->total_working_days }}" @endisset>
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
                                    #
                                </th>
                                <th>
                                    Title
                                </th>
                                <th>
                                    Department
                                </th>
                                <th>
                                    Semester
                                </th>
                                <th>
                                    Subject
                                </th>
                                {{-- <th>
                                    Teacher
                                </th> --}}
                                <th>
                                    Status
                                </th>
                                <th>
                                    working days
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
                                <td>{{ ucfirst($row->title) }}</td>
                                <td>{{ ucfirst($row->department->name) }}</td>
                                <td>{{ ucfirst($row->semester) }}</td>
                                <td>{{ ucfirst($row->subject->name) }}</td>
                                {{-- <td>{{ ucfirst($row->teacher->name) }}</td> --}}
                                <td class="td-actions">
                                    @if ($row->is_published == 0)
                                    <a href="{{ route('close.publish', ['id'=>$row->id]) }}" rel="tooltip" class="btn btn-warning btn-link" data-original-title=""
                                        title="Not Published" onclick="return confirm('Are you sure?')">
                                        <i class="material-icons">assignment_late</i>
                                    </a>
                                    @else
                                    <button class="btn btn-success" href="" rel="tooltip" title="Published"><i
                                            class="material-icons">assignment_turned_in</i></button>
                                    @endif
                                </td>
                                <td>{{ $row->total_working_days }}</td>
                                <td class="td-actions text-right">
                                    <a href="{{ route('close.studentList', [ 'id' => $row->id ]) }}" rel="tooltip"
                                        class="btn btn-warning btn-link" data-original-title=""
                                        title="Show student list">
                                        <i class="material-icons">persone</i>
                                    </a>

                                    @if (Auth()->user()->type == 1 || Auth()->user()->id == $row->teacher_id)
                                    <a href="{{ route('close.export', ['id'=>$row->id]) }}" rel="tooltip"
                                        class="btn btn-success btn-link" data-original-title="" title="Export">
                                        <i class="material-icons">article</i>
                                    </a>
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

                // html = '<option disabled>Select Subject</option>';

                // $(data['students']).each(function (key,value) {
                //     html += '<option value="'+value['id']+'">'+value['name']+'</option>';
                // })

                // console.log(html);
                // $('#students').html(html);

            }
        })
    });
</script>
@endsection