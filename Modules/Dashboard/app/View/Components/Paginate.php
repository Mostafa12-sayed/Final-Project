<?php

namespace Modules\Dashboard\app\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Paginate extends Component
{
    /**
     * Create a new component instance.
     */
    public $elementPaginate;

    public function __construct($items)
    {
        $this->elementPaginate = $items;
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('dashboard::components.paginate');
    }
}
