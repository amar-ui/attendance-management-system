<?php

namespace App\Http\Controllers;

use App\Course;
use App\Department;
use App\Exports\AttendanceExport;
use App\Exports\ExcelExport;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
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
        $data = User::where('type', 3)->get();
        $departments = Department::all();

        return view('student.form', compact('departments', 'data'));
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
            'name'  =>  'required|max:255',
            'department_id'    =>  'required',
            'email'    =>  'required|email|unique:users',
            'password'  =>  'required|max:191',
            'phone'    =>  'required|max:255',
            'gender'    =>  'required',
            'address'    =>  'required|max:255',
            'semester'  =>  'required|numeric',
        ]);

        try {
            $requestData = $request->all();
            $requestData['type'] = 3; //student
            $requestData['password'] = Hash::make($requestData['password']);

            $userSave = User::create($requestData); //user registration
            $userSave->student()->create($requestData); //teacher details table 

            return redirect()->route('student.create')->with('save', 'Record Updated Successfully.!');
        } catch (\Throwable $th) {
            return back()->with('delete', 'Something went wrong, Please try again.!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::where('type', 3)->get();
        $courses = Course::all();

        $edit = User::find($id);

        return view('student.form', compact('courses', 'data', 'edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validateData = $request->validate([
            'name'  =>  'required',
            'course_id'    =>  'required',
            'phone'    =>  'required|max:255',
            'gender'    =>  'required',
            'address'    =>  'required|max:255',
        ]);

        try {
            $requestData = $request->all();
            $data = User::find($id);

            $data->name = $request->name;
            $data->save();

            $data->student->course_id = $request->course_id;
            $data->student->phone = $request->phone;
            $data->student->gender = $request->gender;
            $data->student->address = $request->address;
            $data->student->save();

            return redirect()->route('student.create')->with('save', 'Record Updated Successfully.!');
        } catch (\Throwable $th) {
            return back()->with('delete', 'Something went wrong, Please try again.!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = User::findOrFail($id);

            $data->student->delete();
            $data->delete();

            return redirect()->route('student.create')->with('save', 'Record Deleted Successfully.!');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('delete', 'Something went wrong, Please try again.!!');
        }
    }

    public function studentList(Request $request)
    {
        $department = Department::all();
        $courses = Course::all();

        $data = [];

        if (isset($request->submit)) {
            $data = User::where('type', 3)
                ->JOIN('student_details as sd', 'sd.user_id', 'users.id')
                ->select('users.*');

            if ($request->course_id) {
                $data = $data->where('department_id', $request->department_id);
            }

            if ($request->semester) {
                $data = $data->where('semester', $request->semester);
            }

            $data = $data->get();

            if ($request->submit == 1) {
                return Excel::download(new ExcelExport(['data' => $data, 'view' => 'student.student-list-table']), 'studentList-Export.xlsx');
            }
        }

        return view('student.student-list', compact('department', 'data'));
    }
}
