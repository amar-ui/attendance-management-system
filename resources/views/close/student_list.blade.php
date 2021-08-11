@extends('layouts.master')

@section('title','Student')

@section('pageTitle', 'Attendance')

@section('content')

<div class="row">

    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">list</i>
                </div>
                <h4 class="card-title ">Attendance List</h4>
            </div>
            <div class="card-body">

                <div class="col-md-12">
                    <a href="{{ route('close.export', ['id'=>$close->id]) }}" class="btn btn-xs btn-primary float-right" title="Export to Excel"><i class="material-icons">article</i></a>
                </div>

                <br>
                <br>
                <hr>
                <div class="table-responsive">
                    <table id="datatables" class="table">

                        <thead>
                            <tr>
                                <th colspan="3">
                                    <b>Department of {{ ucfirst($close->department->name)  }}</b>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="3">
                                    <b>Semester : {{ ucfirst($close->semester) }}</b>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="3">
                                    <b>Subject : {{ ucfirst($close->subject->name) }}</b>
                                </th>
                            </tr>
                            <tr>
                                <th>#</th>
                                <th><b>Student</b></th>
                                <th><b>Attendance</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $twd = $close->total_working_days;
                            @endphp
                            @foreach ($attendance as $row)
                            <tr>
                                <td>
                                    {{ $loop->index + 1 }}
                                </td>
                                <td>
                                    {{ $row->name }}
                                </td>
                                <td>
                                    {{ 100 - round((($row->count / $twd) * 100), 2).".%" }}
                                </td>
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

@section('script')

<script>
    $('select').select2({
        theme: "classic"
    });

    $('#semester').change(function () {
        var course_id = $('#course_id').val();
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