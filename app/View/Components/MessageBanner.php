<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MessageBanner extends Component
{
    /**
     * Create a new component instance.
     */
    public $msg;
    public $class;
    public function __construct($msg = null, $class = null)
    {
        $this->msg = $msg ?? session('success') ?? session('error');
        $this->class = $class ?? (session('success') ? 'alert-success' : (session('error') ? 'alert-danger' : ''));;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        return view('components.message-banner');
    }
}
