<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormInput extends Component
{
    public $name;
    public $label;
    public $type;
    public $required;

    /**
     * Create a new component instance.
     */
    public function __construct(string $name, string $label, string $type, string $required)
    {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('landingPage.form.form-input');
    }
}
