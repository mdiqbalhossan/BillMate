<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ClientInformation;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Client::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('name', function ($row){
                    $name = '<div><img src="'.$row->avatar.'" alt="" width="32px">';
                    $name .= '&nbsp;&nbsp;<span>'.$row->first_name .' '. $row->last_name.'</span>';
                    $name .= '</div>';
                    return $name;
                })
                ->editColumn('address', function ($row){
                    $address = "<span>".$row->address."</span><br>";
                    $address .= "<span>" . $row->state . "</span>, " . $row->city . "<br>";
                    $address .= "<span>" . $row->country . "</span>- " . $row->zip_code . "<br>";
                    return $address;
                })
                ->editColumn('created_at', function ($row){
                    return "<span title='".$row->created_at."'> ".$row->created_at->diffForHumans()."</span>";
                })
                ->addColumn('action', function($row){
                    $btn = '<div class="d-flex justify-content-between">';
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="text-success editBtn"><i class="uil uil-edit"></i></a>';
                    $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="text-danger dltbtn"><i class="uil uil-trash-alt"></i></a>';
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['action', 'address', 'created_at', 'name'])
                ->make(true);

        }
        return view('admin.client.index');
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
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'zip_code' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'password' => 'confirmed',
        ]);

        if($request->has('is_create_account')){
            $user = User::create([
                'name' => $request->first_name . ' '. $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user_id = $user->id;
            Mail::to($request->email)->send(new ClientInformation($user, $request->password));
        }else{
            $user_id = null;
        }

        $client = Client::updateOrCreate(['id' => $request->id],
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'website' => $request->website,
                'zip_code' => $request->zip_code,
                'country' => $request->country,
                'state' => $request->state,
                'city' => $request->city,
                'address' => $request->address,
                'notes' => $request->notes,
                'user_id' => $user_id,
            ]);
        $client->avatar = $client->generateAvatar($client->first_name);
        $client->save();
        return response()->json(['success'=>'Product saved successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return response()->json($client);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return response()->json(['success'=>'Product deleted successfully.']);
    }
}
