<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Course;
use App\Department;
use App\Subject;
use App\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
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
        $courses = Course::all();
        $subjects = Subject::all();
        $students = User::where('type', 3)->get();
        $departments = Department::all();

        $data = Attendance::all();
        // foreach ($data as $r) {
        //     dump($r);
        // }
        // die;
        // dd($data);

        return view('attendance.form', compact('departments', 'subjects', 'students', 'data'));
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
            'date'  =>  'required',
            'department_id' =>  'required',
            'subject_id' =>  'required',
            'semester' =>  'required',
            'description' =>  'nullable|max:255',
        ]);

        $requestData = $request->all();

        try {
            $requestData['teacher_id'] = Auth()->user()->id;
            $requestData['date'] = date('Y-m-d', strtotime($requestData['date']));

            $attendance = Attendance::create($requestData);

            foreach ($requestData['students'] as $row) {
                $attendance->attendanceLog()->create(['student_id' => $row]);
            }

            return redirect()->route('attendance.create')->with('save', 'Attendance entry created.!');

        } catch (\Throwable $th) {
            dd($th->getMessage());
            return back()->with('delete', 'Something went wrong, Please try again!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        $courses = Course::all();
        $subjects = Subject::all();
        $students = User::where('type', 3)->get();
        $data = Attendance::all();

        $edit = $attendance;

        return view('attendance.form', compact('courses', 'subjects', 'students', 'data', 'edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
