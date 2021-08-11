<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\AttendanceClose;
use App\AttendanceLog;
use App\Course;
use App\Department;
use App\Exports\AttendanceExport;
use App\StudentDetail;
use App\Subject;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceCloseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        $subjects = Subject::all();
        $students = User::where('type', 2)->get();

        $data = AttendanceClose::all();

        return view('close.form', compact('departments', 'subjects', 'students', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' =>  'required',
            'total_working_days'    =>  'required',
            'date_from'  =>  'required',
            'date_to'  =>  'required',
            'department_id' =>  'required',
            'subject_id' =>  'required',
            'semester' =>  'required',
            'description' =>  'nullable|max:255',
        ]);

        $requestData = $request->all();

        try {
            $requestData['teacher_id'] = Auth()->user()->id;
            $requestData['date_from'] = date('Y-m-d', strtotime($requestData['date_from']));
            $requestData['date_to'] = date('Y-m-d', strtotime($requestData['date_to']));

            $attendance = AttendanceClose::create($requestData);

            return redirect()->route('close.create')->with('save', 'Entry Published successfully.!');
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            return back()->with('delete', 'Something went wrong, Please try again!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AttendanceClose  $attendanceClose
     * @return \Illuminate\Http\Response
     */
    public function show(AttendanceClose $attendanceClose)
    {
        dd($attendanceClose);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AttendanceClose  $attendanceClose
     * @return \Illuminate\Http\Response
     */
    public function edit(AttendanceClose $attendanceClose)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AttendanceClose  $attendanceClose
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AttendanceClose $attendanceClose)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AttendanceClose  $attendanceClose
     * @return \Illuminate\Http\Response
     */
    public function destroy(AttendanceClose $attendanceClose)
    {
        //
    }

    public function studentList($id)
    {
        $close = AttendanceClose::find($id);

        $data = StudentDetail::where([
            ['department_id', $close->department_id],
            ['semester', $close->semester],
        ])->get();

        $attendance = Attendance::select('u.id', 'u.name', DB::raw("count('al.id') as count"))
            ->where([
                ['attendances.department_id', $close->department_id],
                ['attendances.semester', $close->semester],
                ['attendances.subject_id', $close->subject_id],
                ['attendances.date', '<=', $close->date_to],
                ['attendances.date', '>=', $close->date_from],
            ])
            ->JOIN('attendance_logs as al', 'al.attendance_id', 'attendances.id')
            ->JOIN('users as u', 'u.id', 'al.student_id')
            ->groupBy('u.id', 'u.name')
            ->get();

        return view('close.student_list', compact('data', 'close', 'attendance'))->with('delete', 'Record not published');;
    }

    public function exportList($id)
    {
        $close = AttendanceClose::find($id);

        $attendance = Attendance::select('u.id', 'u.name', DB::raw("count('al.id') as count"))
            ->where([
                ['attendances.department_id', $close->department_id],
                ['attendances.semester', $close->semester],
                ['attendances.subject_id', $close->subject_id],
                ['attendances.date', '<=', $close->date_to],
                ['attendances.date', '>=', $close->date_from],
            ])
            ->JOIN('attendance_logs as al', 'al.attendance_id', 'attendances.id')
            ->JOIN('users as u', 'u.id', 'al.student_id')
            ->groupBy('u.id', 'u.name')
            ->get();

        return Excel::download(new AttendanceExport(['attendance' => $attendance, 'close' => $close, 'view' => 'close.export_form']), 'AttendanceList-' . $close->department->name . '-' . $close->semester . '.xlsx');
    }

    public function publish($id)
    {
        try {
            //code...
            $data = AttendanceClose::find($id);

            $data->is_published = 1;
            $data->save();

            return back()->with('save', 'Record published');
        } catch (\Throwable $th) {
            //throw $th;

            return back()->with('delete', "Something went wrong, ".$th->getMessage());
        }

    }
}
