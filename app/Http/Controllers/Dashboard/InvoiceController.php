<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{

    public function index()
    {
        return view('dashboard.invoices.index');
    }

    public function create()
    {
        $sections = Section::all();
        return view('dashboard.invoices.create', compact('sections'));
    }

    public function getProducts($id)
    {
        $products = DB::table("products")->where('section_id', $id)->pluck('name', 'id');
        return json_encode($products);
    }

    public function store(Request $request) {
        return $request;
    }
}
