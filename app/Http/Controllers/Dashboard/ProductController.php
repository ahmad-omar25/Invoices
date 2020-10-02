<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $sections = Section::selection()->orderBy('id', 'desc')->get();
        $products = Product::selection()->orderBy('id', 'desc')->get();
        return view('dashboard.products.index', compact('products', 'sections'));
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'created_by' => auth()->user()->name,
            'section_id' => $request->input('section_id'),
        ]);
        toast('تم الاضافة بنجاح', 'success');
        return redirect()->route('products.index', compact('product'));
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            toast('حدث خطا ما حاول مرة اخري', 'error');
            return redirect()->route('products.index');
        }
        $product->update($request->except('_token'));
        toast('تم التعديل بنجاح', 'success');
        return redirect()->route('products.index', compact('product'));
    }

    public function destroy($id) {
        $product = Product::find($id);
        if (!$product) {
            toast('حدث خطا ما حاول مرة اخري', 'error');
            return redirect()->route('products.index');
        }
        $product->delete();
        toast('تم الحذف بنجاح', 'success');
        return redirect()->route('products.index', compact('product'));
    }
}
