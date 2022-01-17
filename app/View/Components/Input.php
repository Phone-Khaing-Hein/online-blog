<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public $inputTitle,$name,$type,$value,$form;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($inputTitle="Input Title",$name="name",$type="text",$value=null,$form="")
    {
        $this->inputTitle = $inputTitle;
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
        $this->form = $form;
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
