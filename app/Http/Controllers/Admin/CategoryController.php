<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //Ajax Request
        if ($request->ajax()) {
            //Get All Categories
            $data = Category::latest()->get();
            //DataTables Server Side
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row){
                    return "<span title='".$row->created_at."'> ".$row->created_at->diffForHumans()."</span>";
                })
                ->addColumn('action', function($row){
                    $btn = '<ul class="orderDatatable_actions mb-0 d-flex flex-wrap float-end">';
                    $btn .= '<li><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit editBtn"><i class="uil uil-edit"></i></a></li>';
                    $btn .= '<li><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="remove dltbtn"><i class="uil uil-trash-alt"></i></a></li>';
                    $btn .= '</ul>';
                    return $btn;
                })
                ->rawColumns(['action', 'created_at'])
                ->make(true);
        }

        return view('admin.product.category');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $client = Category::updateOrCreate(['id' => $request->id],
            [
                'name' => $request->name,
            ]
        );

        return response()->json(['success' => 'Category saved successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();
        return response()->json(['success' => 'Category deleted successfully.']);
    }
}
