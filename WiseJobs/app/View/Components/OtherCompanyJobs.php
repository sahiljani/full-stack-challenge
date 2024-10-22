<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OtherCompanyJobs extends Component
{
    public $jobPosting;
    public $companyJobs;
    /**
     * Create a new component instance.
     */
    public function __construct($jobPosting, $companyJobs){

        $this->jobPosting = $jobPosting;
        $this->companyJobs = $companyJobs;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.other-company-jobs');
    }
}
