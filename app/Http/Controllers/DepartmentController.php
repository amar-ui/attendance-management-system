<?php

namespace App\Http\Controllers;

use App\Department;
use App\Subject;
use Illuminate\Http\Request;

class DepartmentController extends Controller
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
        $subjects = Subject::all();

        $data = Department::all();
        return view('department.form', compact('data', 'subjects'));
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
            'description'   =>  'nullable|max:255'
        ]);

        try {
            $data = Department::create($request->all());

            foreach ($request->semester as $key => $value) {
                foreach ($request->subject_id[$key] as $subject) {
                    $data->subjectSemensterRelation()->create(['semester'   =>  $value, 'subject_id'    => $subject]);
                }
            }

            return redirect()->back()->with('save', 'Record saved successfully.!');
        } catch (\Throwable $th) {
            return back()->with('delete', 'Something went wrong, Please try again!! '); //.$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        $edit = $department;
        $data = Department::all();
        return view('department.form', compact('data', 'edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $validateData = $request->validate([
            'name'  =>  'required|max:255|unique:departments,name,' . $request->edit,
            'description'   =>  'nullable|max:255'
        ]);

        try {
            $department->name = $request->name;
            $department->description = $request->description;
            $department->save();

            return redirect()->route('department.create')->with('save', 'Record updated.!');
        } catch (\Throwable $th) {
            return back()->with('delete', 'Something went wrong, Please try again.!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        try {
            //TODO:: check dependancies
            $department->subjectSemensterRelation()->delete();
            
            $department->delete();

            return redirect()->route('department.create')->with('save', 'Record deleted successfully.!');
        } catch (\Throwable $th) {
            return back()->with('delete', 'Somthing went wrong, Please try again.!');
        }
    }
}
