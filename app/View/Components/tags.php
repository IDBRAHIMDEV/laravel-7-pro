<?php

namespace App\View\Components;

use Illuminate\View\Component;

class tags extends Component
{
    public $tags;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tags)
    {
        $this->tags = $tags;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.tags');
    }
}
