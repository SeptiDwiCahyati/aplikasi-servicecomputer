<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Keluhan;
use Illuminate\Support\Facades\Session;


class CustomerController extends Controller
{
    public function addCustomer(Request $request)
    {
        $validatedData = $request->validate([
            'nama_customer' => 'required|max:15',
            'alamat' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        $customer = new Customer();
        $customer->nama_customer = $validatedData['nama_customer'];
        $customer->alamat = $validatedData['alamat'];
        $customer->jenis_kelamin = $validatedData['jenis_kelamin'];
        $customer->save();

        return redirect()->route('customers.index')->with('success', 'Customer berhasil ditambah');

    }

    public function updateCustomer(Request $request, string $customer_id)
    {
        $validatedData = $request->validate([
            'nama_customer' => 'required|max:15',
            'alamat' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        $customer = Customer::findOrFail($customer_id);
        $customer->nama_customer = $validatedData['nama_customer'];
        $customer->alamat = $validatedData['alamat'];
        $customer->jenis_kelamin = $validatedData['jenis_kelamin'];
        $customer->save();

        return redirect()->route('customers.index')->with('success', 'Customer berhasil diperbarui');
    }

    public function getCustomers()
    {
        $customers = Customer::withoutTrashed()->get();
        return view('customers.index', ['customers' => $customers]);
    }

    public function getCustomerById(string $customer_id)
    {
        $customer = Customer::find($customer_id);

        if (!$customer) {
            return response()->json([
                'message' => 'Customer tidak ditemukan'
            ], 404);
        }

        return view('customers.edit', ['customer' => $customer]);
    }





    public function deleteCustomer(string $customer_id)
    {
        $customer = Customer::find($customer_id);

        if (!$customer) {
            return response()->json([
                'message' => 'Customer tidak ditemukan'
            ], 404);
        }

        $complaintsCount = Keluhan::where('customer_id', $customer_id)->count();

        if ($complaintsCount > 0) {
            Session::flash('error', 'Tidak dapat menghapus pelanggan karena masih ada keluhan terkait');
            return redirect()->route('customers.index');
        }

        $customer->delete();
        Session::flash('success', 'Customer berhasil dihapus secara lunak');

        return redirect()->route('customers.index');
    }

}