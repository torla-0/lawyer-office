<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RegisterForm extends Component
{
    /**
     * Create a new component instance.
     */
    public $name;
    public $email;
    public $isFielled;

    public function __construct($name = '', $email = '', $isFielled = false)
    {
        $this->name = $name;
        $this->email = $email;
        $this->isFielled = $isFielled;
    }

    public function render()
    {
        return view('components.register-form');
    }
}
