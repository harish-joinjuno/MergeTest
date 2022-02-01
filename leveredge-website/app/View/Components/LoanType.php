<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LoanType extends Component
{
    public $title;

    public $value;

    public $nextPage;

    /**
     * Create a new component instance.
     *
     * @param $title
     * @param $value
     * @param null $nextPage
     */
    public function __construct($title, $value, $nextPage = null)
    {
        $this->title    = $title;
        $this->value    = $value;
        $this->nextPage = $nextPage;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.loan-type');
    }
}
