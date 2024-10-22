<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model{
    //
    use HasFactory;

    protected $fillable = ['company_id', 'title', 'description', 'location', 'salary', 'position_type'];

    public function company(){
        return $this->belongsTo(Company::class);
    }

    /**
     * Scope for filtering job postings.
     */


     public function scopeFilter($query, $request)
     {
         // Search by title or company name
         if ($request->filled('search')) {
             $query->where('title', 'like', '%' . $request->search . '%')
                   ->orWhereHas('company', function ($q) use ($request) {
                       $q->where('name', 'like', '%' . $request->search . '%');
                   });
         }
 
         // Filter by location
         if ($request->filled('location')) {
             $query->where('location', 'like', '%' . $request->location . '%');
         }
 
         // Filter by salary range
         if ($request->filled('salary_min')) {
             $query->where('salary', '>=', $request->salary_min);
         }
 
         if ($request->filled('salary_max')) {
             $query->where('salary', '<=', $request->salary_max);
         }
 
         // Filter by position type
         if ($request->filled('position')) {
             $query->whereIn('position_type', $request->position);
         }
 
         return $query;
     }


    /**
     * Get similar jobs based on job title.
     */

     public static function getSimilarJobs(JobPosting $jobPosting){
        return self::where('title', 'LIKE', '%' . $jobPosting->title . '%')
            ->where('id', '!=', $jobPosting->id)
            ->limit(5)
            ->get();
    }


}
