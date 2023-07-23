<?php

namespace App\Models\Currency;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Currency
 *
 * @property int $id
 * @property string $global_id
 * @property int $num_code
 * @property string $char_code
 * @property string $title
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Collection|CurrencyExchangeRate[] $currencyExchangeRates
 *
 * @package App\Models\Currency
 */
class Currency extends BaseModel
{
    protected $table = 'currency';

    protected $casts = [
        'num_code' => 'int'
    ];

    protected $fillable = [
        'global_id',
        'num_code',
        'char_code',
        'title'
    ];

    public function currencyExchangeRates(): HasMany
    {
        return $this->hasMany(CurrencyExchangeRate::class);
    }
}
