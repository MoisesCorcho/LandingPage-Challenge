<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormSelect extends Component
{
    public $name;
    public $label;
    public $options;
    /**
     * Create a new component instance.
     */
    public function __construct(string $name, string $label, $options = [])
    {
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('landingPage.form.form-select');
    }
}
