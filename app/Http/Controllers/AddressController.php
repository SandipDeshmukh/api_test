<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressStoreRequest;
use App\Http\Requests\AddressUpdateRequest;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index() {
        $addresses = Address::get();
        
        return response()->json([
            'status' => true,
            'message' => 'Address Fetch Successfully',
            'data' => $addresses,
            'code' => 200
        ]);
    }

    public function create(AddressStoreRequest $request) {
        Address::create($request->only(['user_id', 'address']));
        return response()->json([
            'status' => true,
            'message' => 'Address Created Successfully',
            'data' => [],
            'code' => 200
        ]);
    }
    
    public function edit(AddressUpdateRequest $request) {
        Address::where('id', $request->id)->update($request->only(['user_id', 'address']));
        return response()->json([
            'status' => true,
            'message' => 'Address Update Successfully',
            'data' => [],
            'code' => 200
        ]);
    }

    public function delete($id) {
        $address = Address::where('id', $id)->first();
        if($address){
            $address->delete();
            return response()->json([
                'status' => false,
                'message' => 'Address Delete Successfully',
                'data' => [],
                'code' => 200
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Address not found',
            'data' => [],
            'code' => 200
        ]);
    }
}
