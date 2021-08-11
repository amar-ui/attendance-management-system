<?php

namespace App\Exports;

use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AttendanceExport implements  FromView
{
    public function __construct($data)
    {
        // dd($data);
        $this->attendance = $data['attendance'];
        $this->close = $data['close'];
        $this->view = $data['view'];
    }

    public function view(): View
    {
        return view($this->view, ['attendance' => $this->attendance, 'close' => $this->close]);
    }
}
