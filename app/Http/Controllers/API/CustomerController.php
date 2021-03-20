<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class CustomerController extends Controller
{
    // all customers
    public function index()
    {
        $customers = Customer::join('users', 'customers.user_id', '=', 'users.id')->orderBy('customers.id', 'desc')->get(['users.*', 'customers.*'])->toArray();
        return array_reverse($customers);
    }

    // add customer
    public function add(Request $request)
    {
        // add customer login information to user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt(Hash::make(str_random(8)))
        ]);

        $customer = new Customer([
            'user_id' => $user->id,
            'nationality' => $request->nationality,
        ]);
        $customer->save();

        return response()->json('The customer successfully added');
    }

    // edit customer
    public function edit($id)
    {
        // $customer = Customer::find($id);
        $customer = Customer::join('users', 'customers.user_id', '=', 'users.id')->where('customers.id',$id)->get(['users.*', 'customers.*'])->first();
        return response()->json($customer);
    }

    // update customer
    public function update($id, Request $request)
    {
        $customer = Customer::find($id);
        $customer->update($request->all());

        $user = User::find($customer->user_id);
        $user->update($request->all());

        return response()->json('The customer successfully updated');
    }

    // delete customer
    public function delete($id)
    {
        $customer = Customer::find($id);
        $customer->delete();

        return response()->json('The customer successfully deleted');
    }
}