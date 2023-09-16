<?php

namespace App\Repositories\Eloquent;

use App\Models\Currency\Currency;
use App\Repositories\Interfaces\ICurrencyRepository;
use Illuminate\Support\Facades\Cache;

/**
 * Class CurrencyRepository.
 */
class CurrencyRepository extends BaseRepository implements ICurrencyRepository
{
    public const KEY_CHAR_CODE_ARRAY = 'currency_char_code_array';
    /**
     * @var Currency
     */
    protected $model;

    /**
     * UserRepository constructor.
     *
     * @param Currency $model
     */
    public function __construct(Currency $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $attributes
     * @return Currency|null
     */
    public function existOrCreate(array $attributes = []): ?Currency
    {
        if ($globalId = $attributes['@attributes']['ID'] ?? null) {
            /** @var Currency $model */
            if ($model = Currency::query()->where('global_id', $globalId)->first()) {
                return $model;
            }
            $model = new Currency();
            $model->global_id = (string)$globalId;
            $model->num_code = (string)$attributes['NumCode'];
            $model->char_code = (string)$attributes['CharCode'];
            $model->title = (string)$attributes['Name'];
            if ($model->save()) {
                Cache::forget(self::KEY_CHAR_CODE_ARRAY);

                return $model;
            }
        }

        return null;
    }

    /**
     * @return array
     */
    public function getAllCode(): array
    {
        return Cache::remember(self::KEY_CHAR_CODE_ARRAY, 900, static function () {
            return Currency::query()->pluck('char_code')->toArray();
        });
    }

    /**
     * @param string $code
     * @return Currency|null
     */
    public function getByCode(string $code)
    {
        /** @var Currency $model */
        $model = Currency::query()->where('char_code', $code)->first();

        return $model;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return Currency::query()->count();
    }
}
