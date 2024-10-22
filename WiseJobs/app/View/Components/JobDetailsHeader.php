<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class JobDetailsHeader extends Component
{
    public $jobPosting;
    /**
     * Create a new component instance.
     */
    public function __construct($jobPosting)
    {
        $this->jobPosting = $jobPosting;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.job-details-header');
    }
}
