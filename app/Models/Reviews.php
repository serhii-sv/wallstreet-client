<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Reviews
 *
 * @property int $id
 * @property string $lang_id
 * @property string $name
 * @property string|null $text
 * @property string|null $video
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Language $lang
 * @method static \Illuminate\Database\Eloquent\Builder|Reviews newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reviews newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reviews query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reviews whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reviews whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reviews whereLangId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reviews whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reviews whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reviews whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reviews whereVideo($value)
 * @mixin \Eloquent
 */
class Reviews extends Model
{
    /** @var array $fillable */
    protected $fillable = [
        'lang_id',
        'name',
        'text',
        'video',
        'created_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lang()
    {
        return $this->belongsTo(Language::class, 'lang_id');
    }

}
