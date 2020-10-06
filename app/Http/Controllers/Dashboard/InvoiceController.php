<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceDetails;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{

    public function index()
    {
        $invoices = Invoice::orderBy('id', 'desc')->get();
        return view('dashboard.invoices.index', compact('invoices'));
    }

    public function create()
    {
        $sections = Section::select('id', 'name')->get();
        return view('dashboard.invoices.create', compact('sections'));
    }

    public function getProducts($id)
    {
        $products = DB::table("products")->where('section_id', $id)->pluck('name', 'id');
        return json_encode($products);
    }

    public function store(Request $request)
    {
        Invoice::create([
            'invoice_number' => $request->input('invoice_number'),
            'invoice_date' => $request->input('invoice_date'),
            'due_date' => $request->input('due_date'),
            'product' => $request->input('product'),
            'section_id' => $request->input('section'),
            'amount_collection' => $request->input('amount_collection'),
            'amount_commission' => $request->input('amount_commission'),
            'discount' => $request->input('discount'),
            'rate_vat' => $request->input('rate_vat'),
            'value_vat' => $request->input('value_vat'),
            'total' => $request->input('total'),
            'status' => 'غير مدفوعة',
            'value_status' => '2',
            'note' => $request->input('note'),
            'created_by' => auth()->user()->name,
            'payment_date' => '2020-10-10',
        ]);

        $invoiceId = Invoice::latest()->first()->id;

        InvoiceDetails::create([
            'invoice_id' => $invoiceId,
            'invoice_number' => $request->input('invoice_number'),
            'product' => $request->input('product'),
            'section' => $request->input('section'),
            'status' => 'غير مدفوعة',
            'value_status' => '2',
            'note' => $request->input('note'),
            'created_by' => auth()->user()->name,
        ]);

        toast('تم الاضافة بنجاح', 'success');
        return redirect()->route('invoices.index');
    }

    public function show($id)
    {
        $invoices = Invoice::findOrFail($id);
        return view('dashboard.invoices.show', compact('invoices'));
    }
}
