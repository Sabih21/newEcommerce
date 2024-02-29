<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Product;
use App\Models\ProductImage;
use Auth;
class Homecontroller extends Controller
{
        public function redirect()
    {
        $usertype = Auth::user()->user_type;
        if ($usertype == '1') {


            return view('admin.home');
            

        } else {
            // $product = Product::paginate(10);

            $companies = Company::all();
            return view('home.userpage' , compact('companies'));
        }
    }
        
        
        public function showProductsByCompany($companyId)
    {
        // Find the company
        $company = Company::findOrFail($companyId);

        // Get products related to the company
        $products = Product::where('company_id', $company->id)->get();
        
        return view('home..product.products_by_company', compact('company', 'products'));
    }


}

