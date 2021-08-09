<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TransactionType
 * @package App\Models
 *
 * @property string id
 * @property string name
 * @property float commission
 */
class TransactionType extends Model
{
    use Uuids;
    public $keyType      = 'string';
    /** @var bool $incrementing */
    public $incrementing = false;

    /** @var array $fillable */
    protected $fillable = [
        'name',
        'commission',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'type_id');
    }

    /**
     * @param $name
     * @return TransactionType
     * @throws
     */
    public static function getByName($name)
    {
        return cache()->tags('model_setting')->rememberForever('model_setting_' . $name, function () use ($name) {
            return self::where('name', $name)->first();
        });
    }
}
