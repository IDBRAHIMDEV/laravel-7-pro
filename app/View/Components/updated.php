<?php

namespace App\View\Components;

use Carbon\Carbon;
use Illuminate\View\Component;

class updated extends Component
{
    public $date;

    public $name;

    public $userId;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($date, $name = null, $userId = null)
    {
        $this->date = $date->diffForHumans();
        $this->name = $name;
        $this->userId = $userId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.updated');
    }
}
