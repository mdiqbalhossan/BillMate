<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    //Ajax Request
    public function index(Request $request)
    {
        if ($request->ajax()) {
            //Get All Products
            $data = Product::latest()->get();
            //DataTables Server Side
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row){
                    return "<span title='".$row->created_at."'> ".$row->created_at->diffForHumans()."</span>";
                })
                ->editColumn('category_id', function ($row){
                    return $row->category->name;
                })
                ->editColumn('price', function ($row){
                    return '$'.$row->price;
                })
                ->editColumn('image', function ($row){
                    if ($row->image){
                        return '<img src="'.asset('storage/product/'.$row->image).'" alt="'.$row->name.'" class="img-thumbnail" width="50">';
                    }else{
                        return '<img src="'.asset('img/no.png').'" alt="'.$row->name.'" class="img-thumbnail" width="50">';
                    }
                })
                ->addColumn('action', function($row){
                    $btn = '<ul class="orderDatatable_actions mb-0 d-flex flex-wrap float-end">';
                    $btn .= '<li><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit editBtn"><i class="uil uil-edit"></i></a></li>';
                    $btn .= '<li><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="remove dltbtn"><i class="uil uil-trash-alt"></i></a></li>';
                    $btn .= '</ul>';
                    return $btn;
                })
                ->rawColumns(['action', 'created_at', 'image', 'price', 'category_id'])
                ->make(true);
        }
        //Category
        $categories = \App\Models\Category::all();
        return view('admin.product.index' , compact('categories'));
    }

    //Store Product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'code' => 'required|unique:products,code,'.$request->id,
            'price' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        //Upload Image
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->storeAs('public/product', $imageName);
        }else{
            if (Product::where('id', $request->id)->exists()){
                $product = Product::find($request->id);
                $imageName = $product->image;
            }else{
                $imageName = '';
            }
        }


        $client = Product::updateOrCreate(['id' => $request->id],
            [
                'name' => $request->name,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'code' => $request->code,
                'description' => $request->description,
                'image' => $imageName,
            ]
        );

        return response()->json(['success'=>'Product saved successfully.']);
    }

    //Edit Product
    public function edit($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    //Delete Product

    public function destroy($id)
    {
        $product = Product::find($id);
        //image delete
        if ($product->image){
            unlink('storage/product/'.$product->image);
        }
        $product->delete();
        return response()->json(['success'=>'Product deleted successfully.']);
    }
}
