<?php

namespace App\View\Components;

use Illuminate\View\Component;

class card extends Component
{

    public $title;
    public $text;
    public $items;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $text = null, $items = null)
    {
        $this->title = $title;
        $this->text = $text;
        $this->items = $items;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.card');
    }
}
