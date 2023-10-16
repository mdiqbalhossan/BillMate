<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\ExpensePurpose;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //ajax request
        if ($request->ajax()) {
            $expenses = Expense::with('expensePurpose')->get();
            return DataTables::of($expenses)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return "<span title='" . $row->created_at . "'> " . $row->created_at->diffForHumans() . "</span>";
                })
                ->editColumn('amount', function ($row) {
                    return '$' . $row->amount;
                })
                ->editColumn('expense_category_id', function ($row) {
                    return $row->expensePurpose->name;
                })
                ->editColumn('image', function ($row) {
                    //check is image or pdf or zip

                    if ($row->image) {
                        $ext = pathinfo($row->image, PATHINFO_EXTENSION);
                        if ($ext === 'pdf' || $ext === 'zip') {
                            return '<a href="' . asset('storage/expense/' . $row->image) . '" target="_blank" class="btn btn-icon btn-circle color-primary btn-outline-primary"><i class="svg uil uil-paperclip"></i></a>';
                        } else{
                            return '<img src="' . asset('storage/expense/' . $row->image) . '" alt="' . $row->name . '" class="img-thumbnail" width="50">';
                        }
                    }else {
                        return '<img src="' . asset('img/no.png') . '" alt="' . $row->name . '" class="img-thumbnail" width="50">';
                    }
                })
                ->addColumn('action', function ($row) {
                    $btn = '<ul class="orderDatatable_actions mb-0 d-flex flex-wrap float-end">';
                    $btn .= '<li><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit editBtn"><i class="uil uil-edit"></i></a></li>';
                    $btn .= '<li><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="remove dltbtn"><i class="uil uil-trash-alt"></i></a></li>';
                    $btn .= '</ul>';
                    return $btn;
                })
                ->rawColumns(['action', 'created_at', 'amount', 'expense_purpose_id', 'image'])
                ->make(true);
        }
        $categories = ExpensePurpose::latest()->get();
        return view('admin.expenses.index', compact('categories'));
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
                'reference' => 'required',
                'expense_category_id' => 'required',
                'amount' => 'required|numeric',
                'date' => 'required|date',
                'image' => 'nullable|file|mimes:jpeg,png,jpg,pdf,zip|max:2048',
            ]);
            //Upload Image
            if($request->hasFile('image'))
            {
                $image = $request->file('image');
                $imageName = time().'.'.$image->extension();
                $image->storeAs('public/expense', $imageName);
            }else{
                if (Expense::where('id', $request->id)->exists()){
                    $expense = Expense::find($request->id);
                    $imageName = $expense->image;
                }else{
                    $imageName = '';
                }
            }

            //Date convert
            $date = date('Y-m-d', strtotime($request->date));

            Expense::updateOrCreate(['id' => $request->id],
                [
                    'name' => $request->name,
                    'expense_category_id' => $request->expense_category_id,
                    'amount' => $request->amount,
                    'reference' => $request->reference,
                    'date' => $date,
                    'description' => $request->description,
                    'image' => $imageName,
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
        $expense = Expense::find($id);
        return response()->json($expense);
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
        $expense = Expense::find($id);
        //image delete
        if ($expense->image){
            unlink('storage/expense/'.$expense->image);
        }
        $expense->delete();
        return response()->json(['success' => true, 'status' => 'success']);
    }
}
