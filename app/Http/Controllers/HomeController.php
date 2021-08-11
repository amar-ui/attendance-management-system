<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\AttendanceClose;
use App\AttendanceLog;
use App\Course;
use App\Department;
use App\StudentDetail;
use App\Subject;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $count = '';
        $date = date('Y-m-d');

        $data = [];

        if (auth()->user()->type == 3) {

            $user = auth()->user();

            $closes = AttendanceClose::where([
                ['department_id', $user->student->department_id],
                ['semester', $user->student->semester],
                ['is_published', 1]
            ])->get();

            foreach ($closes as $key => $close) {

                $attendance = Attendance::select(DB::raw("count('al.id') as count"), 's.name as subject')
                    ->where([
                        ['attendances.department_id', $close->department_id],
                        ['attendances.semester', $close->semester],
                        ['attendances.date', '<=', $close->date_to],
                        ['attendances.date', '>=', $close->date_from],
                        ['attendances.subject_id', $close->subject_id],
                        ['u.id', $user->id]
                    ])
                    ->JOIN('attendance_logs as al', 'al.attendance_id', 'attendances.id')
                    ->JOIN('users as u', 'u.id', 'al.student_id')
                    ->JOIN('subjects as s', 's.id', 'attendances.subject_id')
                    ->groupBy('subject')
                    ->first();

                if ($attendance) {
                    $data[$key] = $attendance;
                    $data[$key]['totalWorkingDays'] = $close->total_working_days;
                }
            }
        }

        $studentCount = User::where('type', 3)->count();
        $teacherCount = User::where('type', 2)->count();
        $courseCount = Course::count();
        $departmentCount = Department::count();

        $totalAbsentsToday = AttendanceLog::join('attendances as a', 'a.id', 'attendance_logs.attendance_id')
            ->where('date', $date)
            ->count();

        return view('home', compact('data', 'studentCount', 'teacherCount', 'courseCount', 'departmentCount', 'totalAbsentsToday'));
    }

    public function subjectOnCourseSemester(Request $request)
    {
        $data['subject'] = Subject::JOIN('course_subject_relaions as csr', 'subjects.id', 'csr.subject_id')
            ->select('subjects.*')
            ->where([
                ['csr.semester', $request->semester],
                ['csr.department_id', $request->course_id]
            ])
            ->get();

        $data['students'] = StudentDetail::JOIN('users', 'users.id', 'student_details.user_id')
            ->select('users.name', 'users.id as studentId', 'student_details.*')
            ->where([
                ['department_id', $request->course_id],
                ['semester', $request->semester]
            ])
            ->get();

        return $data;
    }

    public function resetPassword(Request $request)
    {
        $validateData = $request->validate([
            'password'  =>  'required|max:255',
            'id'    =>  'required'
        ]);

        if ($request->password === $request->cpassword) {
            $data = User::find($request->id);
            $data->password = Hash::make($request->password);

            $data->save();

            return back()->with('save', 'Password changed successfully');
        }

        return back()->with('delete', 'password mismatch!!');
    }
}
