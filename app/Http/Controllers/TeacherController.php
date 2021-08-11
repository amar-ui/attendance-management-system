<?php

namespace App\Http\Controllers;

use App\Department;
use App\Exports\ExcelExport;
use App\Subject;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Chart\Title;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::where('type', 2)->get();
        return view('teacher.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = User::where('type', 2)->get();
        $departments = Department::all();
        $subjects = Subject::all();

        return view('teacher.form', compact('departments', 'subjects', 'data'));
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
            'subject_id'    =>  'required',
            'department_id'    =>  'required',
            'subject_id'    =>  'required',
            'email'    =>  'required|email|unique:users',
            'password'  =>  'required|max:191',
            'phone'    =>  'required|max:255',
            'gender'    =>  'required',
            'address'    =>  'required|max:255',
        ]);

        try {
            $requestData = $request->all();
            $requestData['type'] = 2; //teacher
            $requestData['password'] = Hash::make($requestData['password']);

            $userSave = User::create($requestData); //user registration
            $userSave->teacher()->create($requestData); //teacher details table 

            return redirect()->route('teacher.create')->with('save', 'Record Updated Successfully.!');
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
        return back()->with('delete', 'Something went wrong, Please try again.!!');


        $data = User::where('type', 2)->get();
        $departments = Department::all();
        $subjects = Subject::all();
        $edit = User::find($id); //edit record

        return view('teacher.form', compact('departments', 'subjects', 'data', 'edit'));
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

        // dd($request);
        $validateData = $request->validate([
            'name'  =>  'required',
            'subject_id'    =>  'required',
            'department_id'    =>  'required',
            'subject_id'    =>  'required',
            'phone'    =>  'required|max:255',
            'gender'    =>  'required',
            'address'    =>  'required|max:255',
        ]);

        try {
            $requestData = $request->all();
            $data = User::find($id);

            $data->name = $request->name;
            $data->save();

            $data->teacher->department_id = $request->department_id;
            $data->teacher->subject_id = $request->subject_id;
            $data->teacher->phone = $request->phone;
            $data->teacher->gender = $request->gender;
            $data->teacher->address = $request->address;
            $data->teacher->save();

            return redirect()->route('teacher.create')->with('save', 'Record Updated Successfully.!');
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

            $data->teacher->delete();
            $data->delete();

            return redirect()->route('teacher.create')->with('save', 'Record Deleted Successfully.!');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('delete', 'Something went wrong, Please try again.!!');
        }
    }

    public function profile($id)
    {
        $data = User::find($id);

        return view('teacher.profile', compact('data'));
    }

    public function teacherList(Request $request)
    {
        $title = "Teachers list Export";

        $department = Department::all();

        $data = User::where('type', 2)
            ->JOIN('teacher_details as sd', 'sd.user_id', 'users.id')
            ->select('users.*');

        if (isset($request->submit)) {

            if ($request->department_id) {
                $data = $data->where('department_id', $request->department_id);
            }

            $data = $data->get();

            if ($request->submit == 1) {
                return Excel::download(new ExcelExport(['data' => $data, 'view' => 'teacher.teacher-list-table']), 'teacherList-Export.xlsx');
            }
        } else {
            $data = $data->get();
        }

        return view('teacher.teacher-list', compact('department', 'data'));
    }
}
