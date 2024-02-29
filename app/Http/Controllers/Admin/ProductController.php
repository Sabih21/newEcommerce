<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductImage;
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('company')->get();
        $companies = Company::all();

        return view('admin.products.index', compact('products', 'companies'));
    }
    public function showByCompany(Company $company)
    {
        $products = Product::where('company_id', $company->id)->get();
        return view('products.index', compact('products', 'company'));
    }
    public function create()
    {
        $companies = Company::all();
        return view('admin.products.create', compact('companies'));
    }

   
public function store(Request $request)
{
    $request->validate([
        'product_name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'nullable|numeric',
        'qty' => 'nullable|integer',
        'color' => 'nullable|string|max:255',
        'company_id' => 'required|exists:companies,id',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $product = Product::create($request->except('images'));

    $imagePaths = [];
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('product_images', $imageName, 'public');
            $imagePaths[] = $imagePath;

            // Save image path in the product_images table
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $imagePath,
            ]);
        }
    }

    return redirect()->route('products.index')->with('success', 'Product added successfully');
}

    
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $companies = Company::all();

        return view('admin.products.edit', compact('product', 'companies'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'qty' => 'nullable|integer',
            'color' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'company_id' => 'required|exists:companies,id',
        ]);

        $product = Product::findOrFail($id);
        $product->fill($request->except('image'));

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }

            // Upload new image
            $imagePath = $request->file('image')->store('product_images', 'public');
            $product->image_path = $imagePath;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete associated image
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}


