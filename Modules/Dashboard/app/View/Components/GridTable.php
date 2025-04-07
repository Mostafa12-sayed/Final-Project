<?php

namespace Modules\Dashboard\app\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class GridTable extends Component
{
    // public $columns;
    // public $data;

    public function __construct()
    {
        // $this->columns = $columns;
        // $this->data = $data;
    }



    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('dashboard::components.gridtable');
    }
}
