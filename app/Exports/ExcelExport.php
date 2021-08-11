<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExcelExport implements FromView
{
    public function __construct($data)
    {
        $this->data = $data['data'];
        $this->view = $data['view'];
    }
    
    public function view(): View
    {
        return view($this->view, ['data' => $this->data]);
    }
}
