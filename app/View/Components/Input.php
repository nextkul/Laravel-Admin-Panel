<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $type;
    public $name;
    public $placeholder;
    public $class;
    public $value;

    public function __construct($type, $name, $placeholder='', $class='', $value='')
    {
        $this->type        = $type;
        $this->name        = $name;
        $this->placeholder = $placeholder;
        $this->class       = $class;
        $this->value       = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input');
    }
}
