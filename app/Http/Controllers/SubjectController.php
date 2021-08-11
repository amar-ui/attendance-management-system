<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
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
        $data = Subject::all();
        return view('subject.form', compact('data'));
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
            $data = Subject::create($request->all());
            
            return redirect()->back()->with('save', 'Record saved successfully.!');
        } catch (\Throwable $th) {
            return back()->with('delete','Something went wrong, Please try again!! ');//.$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
            $edit = $subject;
            $data = Subject::all();
            return view('subject.form', compact('data', 'edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $validateData = $request->validate([
            'name'  =>  'required|max:255|unique:subjects,name,'.$request->edit,
            'description'   =>  'nullable|max:255'
        ]);
        
        try {
            $subject->name = $request->name;
            $subject->description = $request->description;
            $subject->save();
 
            return redirect()->route('subject.create')->with('save', 'Record updated.!');
        } catch (\Throwable $th) {
            return back()->with('delete', 'Something went wrong, Please try again.!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        try {
            //TODO:: check dependancies
            $subject->delete();

            return redirect()->route('department.create')->with('save', 'Record deleted successfully.!');
        } catch (\Throwable $th) {
            return back()->with('delete', 'Somthing went wrong, Please try again.!');
        }
    }
}
