<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tax;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //ajax request
        if ($request->ajax()) {
            $taxes = Tax::all();
            return DataTables::of($taxes)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return "<span title='" . $row->created_at . "'> " . $row->created_at->diffForHumans() . "</span>";
                })
                ->editColumn('rate', function ($row) {
                    return $row->rate . '%';
                })
                ->editColumn('is_default' , function ($row) {
                    return $row->is_default ? '<span class="badge badge-success py-1">Yes</span>' : '<span class="badge badge-danger py-1">No</span>';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<ul class="orderDatatable_actions mb-0 d-flex flex-wrap">';
                    $btn .= '<li><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit editBtn"><i class="uil uil-edit"></i></a></li>';
                    $btn .= '<li><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="remove dltbtn"><i class="uil uil-trash-alt"></i></a></li>';
                    $btn .= '</ul>';
                    return $btn;
                })
                ->rawColumns(['action', 'created_at', 'is_default', 'rate'])
                ->make(true);
        }

        return view('admin.taxes.index');
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
                'rate' => 'numeric',
            ]);

            $tax = Tax::updateOrCreate(['id' => $request->id],
                [
                    'name' => $request->name,
                    'rate' => $request->rate ?? 0,
                    'is_default' => $request->is_default ? true : false,
                ]);

            if ($request->is_default) {
                Tax::where('id', '!=', $tax->id)->update(['is_default' => false]);
            }

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
        $tax = Tax::find($id);
        return response()->json($tax);
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
        $tax = Tax::find($id);
        $tax->delete();
        return response()->json(['success' => true]);
    }
}
