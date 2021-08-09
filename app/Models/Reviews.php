<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Reviews
 * @package App\Models
 *
 * @property string lang_id
 * @property string name
 * @property string text
 * @property string video
 * @property Carbon created_at
 * @property Carbon updated_at
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
