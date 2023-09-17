<?php

namespace App\Models\Currency;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class CurrencyExchangeRate
 *
 * @property int $id
 * @property int $currency_id
 * @property float $value
 * @property int $date_rate
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Currency $currency
 *
 * @package App\Models\Currency
 */
class CurrencyExchangeRate extends BaseModel
{
    protected $table = 'currency_exchange_rate';

    protected $casts = [
        'currency_id' => 'int',
        'value' => 'float',
        'date_rate' => 'date:Y-m-d'
    ];

    protected $fillable = [
        'value',
        'date_rate',
        'currency_id',
    ];

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
}
