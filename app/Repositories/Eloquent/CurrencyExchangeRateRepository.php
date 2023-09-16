<?php

namespace App\Repositories\Eloquent;

use App\Models\Currency\CurrencyExchangeRate;
use App\Repositories\Interfaces\ICurrencyExchangeRateRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class CurrencyExchangeRateRepository.
 */
class CurrencyExchangeRateRepository extends BaseRepository implements ICurrencyExchangeRateRepository
{
    /**
     * @var CurrencyExchangeRate
     */
    protected $model;

    /**
     * UserRepository constructor.
     *
     * @param CurrencyExchangeRate $model
     */
    public function __construct(CurrencyExchangeRate $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $attributes
     * @return CurrencyExchangeRate|null
     */
    public function existOrCreate(array $attributes = []): ?CurrencyExchangeRate
    {
        /** @var CurrencyExchangeRate $model */
        $model = CurrencyExchangeRate::query()
            ->where('currency_id', $attributes['currency_id'])
            ->where('date_rate', $attributes['date_rate'])
            ->first();
        if ($model) {
            return $model;
        }
        $model = new CurrencyExchangeRate();
        $model->currency_id = $attributes['currency_id'];
        $model->date_rate = $attributes['date_rate'];
        $model->value = $attributes['value'];
        if ($model->save()) {
            return $model;
        }
        return null;
    }

    /**
     * @param array $attributes
     * @return Collection|null
     */
    public function getOneByPeriod(array $attributes = [])
    {
        return CurrencyExchangeRate::query()
            ->select([
                'currency_exchange_rate.value',
                'currency_exchange_rate.date_rate',
                'currency.char_code',
                'currency.title',
            ])
            ->leftJoin('currency', 'currency.id', '=', 'currency_exchange_rate.currency_id')
            ->where('currency_id', $attributes['currency_id'])
            ->where('date_rate', '>=', $attributes['date_start'])
            ->where('date_rate', '<=', $attributes['date_end'])
            ->get();
    }

    /**
     * @param int $date
     * @return int
     */
    public function countByDay(int $date)
    {
        return CurrencyExchangeRate::query()
            ->where('date_rate', $date)
            ->count();
    }
}
