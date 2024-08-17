<?php

namespace App\Services;

class DestroyCurrencyRateService
{

    public function destroy($currency)
    {
        $currencies = config('currency_rates');
        unset($currencies[$currency]);
        file_put_contents(config_path('currency_rates.php'), '<?php return ' . var_export($currencies, true) . ';');
    }

}
