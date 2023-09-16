<?php

namespace App\Services\Currency;

use App\Components\CurrencyAgent;
use App\DTO\CurrencyFiltersDTO;
use App\Models\Currency\Currency;
use App\Models\Currency\CurrencyExchangeRate;
use App\Repositories\Interfaces\ICurrencyExchangeRateRepository;
use App\Repositories\Interfaces\ICurrencyRepository;
use App\Services\BaseServices;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use SimpleXMLElement;

class CurrencyServices extends BaseServices
{
    public ICurrencyRepository $currency;
    public ICurrencyExchangeRateRepository $currencyExchangeRate;

    /**
     * @param ICurrencyRepository $currency
     * @param ICurrencyExchangeRateRepository $currencyExchangeRate
     */
    public function __construct(
        ICurrencyRepository $currency,
        ICurrencyExchangeRateRepository $currencyExchangeRate
    ) {
        $this->currency = $currency;
        $this->currencyExchangeRate = $currencyExchangeRate;
    }

    /**
     * @return Collection
     */
    public function getAllCurrency()
    {
        return $this->currency->all();
    }

    /**
     * @param int $date
     * @return void
     */
    public function saveExchangeRateForDay(int $date): void
    {
        /** @var SimpleXMLElement $rateList */
        $rateList = (new CurrencyAgent($date))->getList();
        $rateDate = strtotime((string)$rateList['Date']);
        foreach ($rateList as $item) {
            /** @var Currency $currency */
            if ($currency = $this->currency->existOrCreate((array)$item)) {
                $val = str_replace(',', '.', $item->Value);
                $this->currencyExchangeRate->existOrCreate([
                    'value' => (float)$val,
                    'date_rate' => $rateDate,
                    'currency_id' => $currency->id,
                ]);
            }
        }
    }

    /**
     * @param CurrencyFiltersDTO $currencyDto
     * @return Collection|null
     */
    public function getExchangeRateForFilter(CurrencyFiltersDTO $currencyDto)
    {
        $key = md5($currencyDto->toJson());
        $_this = $this;
        /** @var Currency $currency */
        if ($currency = $_this->currency->getByCode($currencyDto->currency)) {
            $dateEnd = $_this->getValidTime(strtotime($currencyDto->date));
            $dateStart = $_this->getValidTime($dateEnd - (60 * 60 * 24));
            /** @var CurrencyExchangeRate[] $rate */
            $rate = $_this->currencyExchangeRate->getOneByPeriod([
                'currency_id' => $currency->id,
                'date_start' => $dateStart,
                'date_end' => $dateEnd,
            ]);
            if (count($rate) < 2) {
                $dates = [];
                foreach ($rate as $item) {
                    $dates[] = $item->date_rate;
                }
                $newDates = array_diff([$dateStart, $dateEnd], $dates);
                foreach ($newDates as $value) {
                    $_this->saveExchangeRateForDay($value);
                }
                $rate = $_this->currencyExchangeRate->getOneByPeriod([
                    'currency_id' => $currency->id,
                    'date_start' => $dateStart,
                    'date_end' => $dateEnd,
                ]);
            }
            return $rate;
        }
        return null;
    }

    /**
     * Вернем рабочий СБРФ день недели
     *
     * @param int $time
     * @return float|int
     */
    private function getValidTime(int $time): float|int
    {
        $timeNew = $time;
        $dayOfTheWeek = Carbon::createFromTimestamp($time)->dayOfWeek;
        if ($dayOfTheWeek === 0) {
            $timeNew = $time - (60 * 60 * 24);
        }
        if ($dayOfTheWeek === 1) {
            $timeNew = $time - (60 * 60 * 24 * 2);
        }
        return $timeNew;
    }

    /**
     * @param int $date
     * @return bool
     */
    public function isExistRate(int $date): bool
    {
        $dayOfTheWeek = Carbon::createFromTimestamp($date)->dayOfWeek;
        if ($dayOfTheWeek === 0 || $dayOfTheWeek === 1) {
            return true;
        }
        $countCurrency = $this->currency->count();
        $countCurrencyRate = $this->currencyExchangeRate->countByDay($date);
        if ($countCurrency) {
            return $countCurrency === $countCurrencyRate;
        }
        return false;
    }
}
