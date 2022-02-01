<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AcademicYearCard extends Component
{
    public $title;

    public $value;

    public $id;

    /**
     * Create a new component instance.
     *
     * @param $title
     * @param $value
     */
    public function __construct($title, $value, $id)
    {
        $this->title = $title;
        $this->value = $value;
        $this->id    = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.academic-year-card');
    }
}
