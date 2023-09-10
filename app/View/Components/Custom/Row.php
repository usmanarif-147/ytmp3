<?php

namespace App\View\Components\Custom;

use Illuminate\View\Component;

class Row extends Component
{

    public $label, $required, $property, $element, $placeholder;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $required, $property, $element, $placeholder)
    {
        $this->label =  $label;
        $this->required =  $required;
        $this->property =  $property;
        $this->element =  $element;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.custom.row');
    }
}
