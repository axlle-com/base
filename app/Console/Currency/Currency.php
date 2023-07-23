<?php

namespace App\Console\Currency;

use App\Jobs\Currency\UpdateCurrencyExchangeRate;
use Illuminate\Console\Command;

class Currency extends Command
{
    protected $signature = 'currency'; #php artisan currency

    protected $description = 'Command description';

    public function handle(): void
    {
        $period = 180; # Количество дней
        $date = strtotime(date('d.m.Y'));
        for ($i = 0; $i < $period; $i++) {
            $prevDate = $date - (60 * 60 * 24) * $i;
            UpdateCurrencyExchangeRate::dispatch($prevDate);
        }
        echo $i;
    }
}
