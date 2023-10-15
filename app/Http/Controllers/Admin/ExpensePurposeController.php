<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExpensePurpose;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ExpensePurposeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //ajax request with datatables
        if ($request->ajax()) {
            //Get All Expense Purposes
            $data = ExpensePurpose::latest()->get();
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
        return view('admin.expenses.purpose');
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

                $client = ExpensePurpose::updateOrCreate(['id' => $request->id],
                    [
                        'name' => $request->name,
                        'description' => $request->description,
                    ]
                );

                return response()->json(['success' => true, 'status' => 'success']);
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
        $purpose = ExpensePurpose::find($id);
        return response()->json($purpose);
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
        $purpose = ExpensePurpose::find($id);
        $purpose->delete();
    }
}
