<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Action extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $class;
    public $title;
    public $icon;
   
    public function __construct($class, $title, $icon)
    {
        $this->class        = $class;
        $this->title        = $title;
        $this->icon        = $icon;
     
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.action');
    }
}
