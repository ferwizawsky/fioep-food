<?php

namespace App\Http\Controllers;

use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function index(Request $request)
    {
        $data = Invoice::where('notes', 'LIKE', '%' . $request->cari . '%')
            ->orderBy('created_at', 'DESC')->paginate($request->limit ?? 10);
        return InvoiceResource::collection($data);
    }


    public function store(Request $request)
    {
        $credentials = $request->validate([
            'paid' => 'required',
            'product_id.*' => 'required',
        ]);
        $product = $request->product;
        $chart = [];
        $price = 0;
        foreach ($product as $index) {
            $tmp = Product::find($index['id']);
            $tmp->value = (int)$index['value'];
            if ($tmp) array_push($chart, $tmp);
        }
        foreach ($chart as $index) {
            $price += $index->price * $index->value;
        }
        if ($request->paid < $price) {
            return response()->json([
                "message" => "Paid should above price"
            ], 402);
        }
        $tmp = Invoice::create([
            'note' => $request->note,
            'paid' => $request->paid,
            'product' => json_encode($chart),
            'price' => $price,
            'user_id' => $request->user()?->id ?? 1
        ]);
        return new InvoiceResource($tmp);
    }

    public function get($id)
    {
        $data = Invoice::find($id);
        if (!$data) return response()->json([
            "message" => "Not Found"
        ], 404);
        return new InvoiceResource($data);
    }


    public function edit($id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
