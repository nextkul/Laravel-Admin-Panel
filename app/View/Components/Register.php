<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Register extends Component
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

    public function __construct($type, $name, $placeholder, $class)
    {
        $this->type        = $type;
        $this->name        = $name;
        $this->placeholder = $placeholder;
        $this->class       = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.register');
    }
}
