<?php

namespace App\View\Components\Cards;

use Illuminate\View\Component;

class LoanTypeCard extends Component
{
    public $title;

    public $loanType;

    public $button;

    public $nextPage;

    /**
     * Create a new component instance.
     *
     * @param $title
     * @param $loanType
     * @param $button
     * @param null $nextPage
     */
    public function __construct($title, $loanType, $button, $nextPage = null)
    {
        $this->title    = $title;
        $this->loanType = $loanType;
        $this->button   = $button;
        $this->nextPage = $nextPage;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.loan-type-card');
    }
}
