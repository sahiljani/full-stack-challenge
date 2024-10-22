<?php
namespace App\Http\Controllers;

use App\Models\JobPosting;
use Illuminate\Http\Request;

class JobListingController extends Controller
{
    public function index(Request $request)
    {
        $minSalary = JobPosting::min('salary');
        $maxSalary = JobPosting::max('salary');

        $query = JobPosting::query();

        $query = $this->applySearchFilter($query, $request);
        $query = $this->applyLocationFilter($query, $request);
        $query = $this->applySalaryFilter($query, $request);
        $query = $this->applyPositionTypeFilter($query, $request);
        $query = $this->applyCompanyFilter($query, $request);

        // Retrieve the filtered job postings with pagination
        $jobPostings = $query->with('company')->paginate(10)->appends($request->all());


        return view('jobs.index', compact('jobPostings', 'minSalary', 'maxSalary'));
    }

    public function show($id)
    {
        $jobPosting = JobPosting::with('company')->findOrFail($id);
        
        $companyJobs = $this->getCompanyJobs($jobPosting->company->id, $id);
        $similarJobs = $this->getSimilarJobs($jobPosting->title, $id);

        return view('jobs.show', compact('jobPosting', 'companyJobs', 'similarJobs'));
    }

    // Separate methods for filtering logic
    private function applySearchFilter($query, Request $request)
    {
        if ($request->filled('search')) {
            return $query->where('title', 'like', '%' . $request->search . '%')
                         ->orWhereHas('company', function ($q) use ($request) {
                             $q->where('name', 'like', '%' . $request->search . '%');
                         });
        }
        return $query;
    }

    private function applyLocationFilter($query, Request $request)
    {
        if ($request->filled('location') && $request->location != 'Select your city') {
            return $query->where('location', 'like', '%' . $request->location . '%');
        }
        return $query;
    }

    private function applySalaryFilter($query, Request $request){
        if ($request->filled('salary_min')) {
            $query->where('salary', '>=', $request->salary_min);
        }
        if ($request->filled('salary_max')) {
            $query->where('salary', '<=', $request->salary_max);
        }
        return $query;
    }

    private function applyPositionTypeFilter($query, Request $request)
    {
        if ($request->filled('position')) {
            return $query->whereIn('position_type', $request->position);
        }
        return $query;
    }

    private function applyCompanyFilter($query, Request $request)
    {
        if ($request->filled('company')) {
            return $query->whereHas('company', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->company . '%');
            });
        }
        return $query;
    }

    // Separate methods for retrieving related jobs
    private function getCompanyJobs($companyId, $jobId)
    {
        return JobPosting::where('company_id', $companyId)
                         ->where('id', '!=', $jobId)
                         ->limit(5)
                         ->get();
    }

    private function getSimilarJobs($title, $jobId)
    {
        return JobPosting::where('title', 'LIKE', '%' . $title . '%')
                         ->where('id', '!=', $jobId)
                         ->limit(5) 
                         ->get();
    }
}
