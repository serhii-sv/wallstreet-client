<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\News
 *
 * @property string $id
 * @property array $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property array|null $short_content
 * @property string|null $image
 * @property array|null $title
 * @method static \Illuminate\Database\Eloquent\Builder|News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News query()
 * @method static \Illuminate\Database\Eloquent\Builder|News whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereShortContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class News extends Model
{
    use Uuids;

    /**
     * @var string
     */
    public $keyType = 'string';

    /**
     * @var bool
     */
    public $incrementing = false;

    /** @var string $table */
    protected $table = 'news';

    /** @var array $fillable */
    protected $fillable = [
        'content',
        'title',
        'short_content',
        'image',
        'views',
        'likes'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'content' => 'array',
        'title' => 'array',
        'short_content' => 'array',
    ];
    public function language()
    {
        return $this->belongsTo(Language::class, 'id');
    }
    
    public function getTitle($lang) {
        //dd($this->title);
        $title_list = $this->title;
        if (array_key_exists($lang, $title_list)) {
            return $title_list[$lang];
        } else {
            return array_shift($title_list);
        }
    }
    
    public function getShortContent($lang) {
        $title_list = $this->short_content;
        if (array_key_exists($lang, $title_list)) {
            return $title_list[$lang];
        } else {
            return array_shift($title_list);
        }
    }
    
    public function getContent($lang) {
        $title_list = $this->content;
        if (array_key_exists($lang, $title_list)) {
            return $title_list[$lang];
        } else {
            return array_shift($title_list);
        }
    }
}
