<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RegisterForm extends Component
{
    public $departamentCities;
    /**
     * Create a new component instance.
     */
    public function __construct(array $departamentCities)
    {
        $this->departamentCities = $departamentCities;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('landingPage.form.register-form');
    }
}
