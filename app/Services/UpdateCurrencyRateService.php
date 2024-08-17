<?php

namespace App\Services;

class UpdateCurrencyRateService
{

    public function update($request , $currency)
    {
        $currencies = config('currency_rates');
        $currencies[$currency] = $request->rate;
        file_put_contents(config_path('currency_rates.php'), '<?php return ' . var_export($currencies, true) . ';');
    }

}
