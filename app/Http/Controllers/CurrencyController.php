<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCurrencyRateRequest;
use App\Http\Requests\DestroyCurrencyRateRequest;
use App\Http\Requests\UpdateCurrencyRateRequest;
use App\Services\CreateCurrencyRateService;
use App\Services\DestroyCurrencyRateService;
use App\Services\UpdateCurrencyRateService;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public $createCurrencyRateService;
    public $updateCurrencyRateService;
    public $destroyCurrencyRateService;

    public function __construct(CreateCurrencyRateService $createCurrencyRateService, UpdateCurrencyRateService $updateCurrencyRateService, DestroyCurrencyRateService $destroyCurrencyRateService)
    {
        $this->createCurrencyRateService = $createCurrencyRateService;
        $this->updateCurrencyRateService = $updateCurrencyRateService;
        $this->destroyCurrencyRateService = $destroyCurrencyRateService;

    }


    public function index()
    {
        $currencies = config('currency_rates');
        return view('currencies.index', compact('currencies'));
    }



    public function store(CreateCurrencyRateRequest $request)
    {
        try {
            $this->createCurrencyRateService->create($request);

            toastr()->success('Currency Rate is  Created Successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }


    }


    public function update(UpdateCurrencyRateRequest $request, $currency)
    {
        try {
            $this->updateCurrencyRateService->update($request, $currency);
            toastr()->warning('Currency Rate is  Updated Successfully');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

    }

    public function destroy(DestroyCurrencyRateRequest $request, $currency)
    {
        try {
            $this->destroyCurrencyRateService->destroy($currency);
            toastr()->error('Currency Rate is  Deleted Successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
