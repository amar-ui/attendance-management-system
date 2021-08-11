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
            <th>
                Phone
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
            <td>{{ $row->teacher->phone}}</td>

        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="3">No records</td>
        </tr>
        @endif
    </tbody>
</table>