<?php

namespace App\Http\Controllers;

use App\Course;
use App\Department;
use App\Exports\ExcelExport;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CourseController extends Controller
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
        $data = Department::all();
        $departments = Department::all();
        $subjects = Subject::all();

        return view('course.form', compact('data', 'departments', 'subjects'));
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
            'department_id' =>  'required',
            'description'   =>  'nullable|max:255'
        ]);

        DB::beginTransaction();
        try {
            // $data = Course::create($request->all());
            $data = Department::find($request->department_id);

            // dd($request);
            foreach ($request->semester as $key => $value) {
                foreach ($request->subject_id[$key] as $subject) {
                    $data->subjectSemensterRelation()->create(['semester'   =>  $value, 'subject_id'    => $subject]);
                }
            }

            DB::commit();
            return redirect()->back()->with('save', 'Record saved successfully.!');
        } catch (\Throwable $th) {
            DB::rollback();
            // dd($th->getMessage());
            return back()->with('delete', 'Something went wrong, Please try again!! '); //.$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $data = Course::all();
        $departments = Department::all();
        $edit = $course;

        return view('course.form', compact('data', 'departments', 'edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $validateData = $request->validate([
            'name'  =>  'required|max:255|unique:departments,name,' . $request->edit,
            'department_id' =>  'required',
            'description'   =>  'nullable|max:255'
        ]);

        try {
            $course->name = $request->name;
            $course->department_id = $request->department_id;
            $course->description = $request->description;
            $course->save();

            return redirect()->route('course.create')->with('save', 'Record updated.!');
        } catch (\Throwable $th) {
            return back()->with('delete', 'Something went wrong, Please try again.!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        try {
            //TODO:: check dependancies
            $course->subjectSemensterRelation()->delete();
            $course->delete();

            return redirect()->route('course.create')->with('save', 'Record deleted successfully.!');
        } catch (\Throwable $th) {
            return back()->with('delete', 'Somthing went wrong, Please try again.!');
        }
    }

    public function courseList(Request $request)
    {
        $title = "Course list Export";

        $data = Department::all();

        // $data = Department::query();

        if (isset($request->submit)) {

            // if ($request->department_id) {
            //     $data = $data->where('department_id', $request->department_id);
            // }

            // if ($request->semester) {
            //     $data = $data->where('semester', $request->semester);
            // }

            // $data = $data->get();

            if ($request->submit == 1) {
                return Excel::download(new ExcelExport(['data' => $data, 'view' => 'course.course-list-table']), 'Department-Export.xlsx');
            }
        }

        return view('course.course-list', compact('data'));
    }
}
