<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\JobPosting;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;

class JobPostingController extends Controller
{
    public function index()
    {
        $jobPostings = JobPosting::with('company')->get();
        $jobPostings = $jobPostings->take(10);
        
        return view('admin.job_postings.index', compact('jobPostings'));
    }

    public function loadmore(Request $request){
         // Use pagination with 'load more' functionality
    $jobPostings = JobPosting::with('company')
    ->orderBy('created_at', 'asc')
    ->paginate(10);

return response()->json($jobPostings);
    }

    public function create()
    {
        $companies = Company::all();
        return view('admin.job_postings.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'job_type' => 'required|in:full-time,part-time,contract',
            'salary_type' => 'required|in:monthly,hourly',
        ]);

        JobPosting::create($request->all());

        return redirect()->route('admin.job_postings.index')->with('success', 'Job posting created successfully.');
    }

    
    public function edit($id){
      
        $jobPosting = JobPosting::findOrFail($id);
        $companies = Company::all();
        return view('admin.job_postings.edit', compact('jobPosting', 'companies'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'job_type' => 'required|in:full-time,part-time,contract',
            
        ]);
    
        try {
            $jobPosting = JobPosting::findOrFail($id);
            $jobPosting->update($request->all());
    
            return redirect()->route('admin.job_postings.index')->with('success', 'Job posting updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update job posting.'])->withInput();
        }
    }
    

    public function destroy($id)
    {   

        $jobPosting = JobPosting::findOrFail($id);
        $jobPosting->delete();
        // return Json
        return response()->json(['message' => 'Job posting deleted successfully.']);

    }
}
