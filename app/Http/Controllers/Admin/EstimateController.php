<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Estimate;
use App\Models\Product;
use App\Models\Tax;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EstimateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $estimates = Estimate::with('client')->get();
            return Datatables::of($estimates)
                ->editColumn('estimate_number', function ($row) {
                    return '<a href="' . route('admin.estimate.show', $row->id) . '">EST- ' . $row->estimate_number . '</a>';
                })
                ->editColumn('client', function ($row) {
                    return $row->client->name;
                })
                ->editColumn('date', function ($row) {
                    return date('d M, Y', strtotime($row->estimate_date));
                })
                ->editColumn('status', function ($row) {
                    if ($row->status === 'draft') {
                        return '<span class="badge badge-pill badge-light-warning font-size-12">Draft</span>';
                    } elseif ($row->status === 'sent') {
                        return '<span class="badge badge-pill badge-light-primary font-size-12">Sent</span>';
                    } elseif ($row->status === 'accepted') {
                        return '<span class="badge badge-pill badge-light-success font-size-12">Accepted</span>';
                    } elseif ($row->status === 'declined') {
                        return '<span class="badge badge-pill badge-light-danger font-size-12">Declined</span>';
                    }
                })
                ->editColumn('total', function ($row) {
                    return '$'.$row->total;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<ul class="orderDatatable_actions mb-0 d-flex flex-wrap float-end">';
                    $btn .= '<li><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit editBtn"><i class="uil uil-edit"></i></a></li>';
                    $btn .= '<li><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="remove dltbtn"><i class="uil uil-trash-alt"></i></a></li>';
                    $btn .= '</ul>';
                    return $btn;
                })
                ->rawColumns(['action', 'status', 'total', 'estimate_number'])
                ->make(true);
        }

        return view('admin.estimates.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        $products = Product::where('status', 1)->get();
        $estimateNumber = Helpers::generateEstimateNumber();
        $taxes = Tax::all();
        return view('admin.estimates.create', compact('clients', 'products', 'estimateNumber', 'taxes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }
}
