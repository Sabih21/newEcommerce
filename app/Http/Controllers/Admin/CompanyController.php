<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('admin.companies.index', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
        ]);

        Company::create([
            'company_name' => $request->input('company_name'),
        ]);

        return redirect()->route('companies.index')->with('success', 'Company added successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
        ]);

        $company = Company::findOrFail($id);
        $company->update([
            'company_name' => $request->input('company_name'),
        ]);

        return redirect()->route('companies.index')->with('success', 'Company updated successfully');
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Company deleted successfully');
    }
}
