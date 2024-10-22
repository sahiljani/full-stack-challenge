<?php

namespace App\View\Components;

use Illuminate\View\Component;

class JobRoleInsights extends Component
{
    public $job;

    /**
     * Create a new component instance.
     *
     * @param  mixed  $job
     * @return void
     */
    public function __construct($job)
    {
        $this->job = $job;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.job-role-insights');
    }
}
