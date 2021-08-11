<style>
    table {
        font-family: arial, sans-serif;
        font-size: 9px;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
        font-size: 11px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>

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
            <td style="align-content: center">
                {{ $loop->index + 1 }}
            </td>
            <td style="align-content: center">
                {{ $row->name }}
            </td>
            <td style="align-content: center">
                {{ 100 - round((($row->count / $twd) * 100), 2).".%" }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>