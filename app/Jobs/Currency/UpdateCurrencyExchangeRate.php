<?php

namespace App\Jobs\Currency;

use App\Jobs\BaseJob;
use App\Services\Currency\CurrencyServices;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Support\Facades\Log;

class UpdateCurrencyExchangeRate extends BaseJob implements ShouldBeUnique
{
    public int $date;

    /**
     * The unique ID of the job.
     *
     * @return int
     */
    public function uniqueId(): int
    {
        return $this->date;
    }

    public function __construct(int $date)
    {
        $this->date = $date;
        parent::__construct();
    }

    public function handle(CurrencyServices $currencyServices): void
    {
        if (!$currencyServices->isExistRate($this->date)) {
            Log::info('UPDATE_CURRENCY_EXCHANGE_RATE: ' . date('d.m.Y', $this->date));
            $currencyServices->saveExchangeRateForDay($this->date);
        }
    }
}
