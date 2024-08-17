<?php

namespace App\Http\Controllers;

use App\Models\Amount;
use App\Http\Requests\StoreAmountRequest;
use App\Http\Requests\UpdateAmountRequest;

class AmountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $amounts = Amount::paginate(5);
        $currencies = config('currency_rates');
        foreach ($amounts as $amount) {
            $amount->exchange_value = $amount->amount * $currencies[$amount->currency];
        }
        return view('amounts.index', compact('amounts'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAmountRequest $request)
    {

        try {
            Amount::create($request->only(['currency', 'amount']));
            toastr()->success('Currency Amount is  Created Successfully');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }


    public function update(UpdateAmountRequest $request, $id)
    {
        try {
            $amount = Amount::find($id);
            $amount->update($request->only(['currency', 'amount']));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            Amount::destroy($id);
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
