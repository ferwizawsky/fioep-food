<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{


    public function index(Request $request)
    {
        $data = Product::where('title', 'LIKE', '%' . $request->cari . '%')
            ->orderBy('created_at', 'DESC')->paginate($request->limit ?? 10);
        return ProductResource::collection($data);
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'title' => 'required',
            'price' => 'required',
        ]);
        $path = "";
        if ($request->image) {
            $path = $this->uploadFile($request->image);
        }
        $data = Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'user_id' => $request->user()?->id ??  1,
            'photo' => $path,
        ]);
        return response()->json([
            "data" => $data
        ], 200);
    }

    public function delete($id)
    {
        $data = Product::find($id);
        if ($data) $data->delete();
        return response()->json([
            "data" => $data
        ], 200);
    }


    public function uploadFile($file)
    {
        // $filename = $file->getClientOriginalName();
        $ext = $file->getClientOriginalExtension();
        $newFilename = 'image-' . rand() . '-' . time() . '.' . $ext;

        Image::configure(['driver' => 'gd']);
        $foto = Image::make($file);
        $foto->resize(680, 680, function ($constraint) {
            $constraint->aspectRatio();
        });
        $upload = Storage::disk("public_uploads")->put('product/' . $newFilename, $foto->encode());
        return 'product/' . $newFilename;
    }
}
