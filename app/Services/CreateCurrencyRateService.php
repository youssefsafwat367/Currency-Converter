<?php

namespace App\Services;

class CreateCurrencyRateService
{

    public function create($request)
    {
        $currencies = config('currency_rates');
        $currencies[$request->currency] = $request->rate;
        file_put_contents(config_path('currency_rates.php'), '<?php return ' . var_export($currencies, true) . ';');
    }

}
