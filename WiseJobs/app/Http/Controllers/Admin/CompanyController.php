<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class CompanyController extends Controller
{
  
    public function index(){
        $companies = Company::withCount('jobPostings')->paginate(10); 
        return view('admin.companies.index', compact('companies')); 

    }

    public function store(Request $request)
{
    // Validate the input
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'location' => 'nullable|string|max:255',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Create a new company
    $company = new Company();
    $company->name = $validated['name'];
    $company->location = $validated['location'];

    // Handle file upload for the logo
    if ($request->hasFile('logo')) {
        $path = $request->file('logo')->store('logos', 'public'); // Store logo in storage/app/public/logos
        $company->logo = $path;
    }

    $company->save();

    return redirect()->route('admin.companies.index')->with('success', 'Company created successfully.');
}

public function update(Request $request, Company $company)
{
    // Validate the request data
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'location' => 'nullable|string|max:255',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Update the existing company's name and location
    $company->name = $validated['name'];
    $company->location = $validated['location'] ?? $company->location; // Keep current location if null

    // Check if a new logo is uploaded
    if ($request->hasFile('logo')) {
        // Delete the old logo if it exists
        if ($company->logo && Storage::disk('public')->exists($company->logo)) {
            Storage::disk('public')->delete($company->logo);
        }

        // Store the new logo and update the logo path
        $path = $request->file('logo')->store('logos', 'public');
        $company->logo = $path;
    }

    // Save the updated company record
    $company->save();

    // Redirect back to the same page in pagination after updating
    return redirect()->route('admin.companies.index', ['page' => $request->input('page')])
        ->with('success', 'Company updated successfully.');
}

public function destroy(Request $request, Company $company)
{

    // If the company has a logo, delete it from storage
    if ($company->logo && Storage::disk('public')->exists($company->logo)) {
        Storage::disk('public')->delete($company->logo);
    }

    // Delete the company
    $company->delete();

    // Redirect back to the same page in pagination after deletion
    return redirect()->route('admin.companies.index', ['page' => $request->input('page')])
        ->with('success', 'Company deleted successfully.');
}



}
