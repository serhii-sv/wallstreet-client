<?php
/*
 * This engine owned and produced by HyipLab studio.
 * Visit our website: https://hyiplab.net/
 */

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class News
 * @package App\Models
 *
 * @property string subject
 * @property string content
 * @property Language language_id
 */
class News extends Model
{
    use Uuids;
    public $keyType      = 'string';
    
    public $incrementing = false;

    /** @var string $table */
    protected $table = 'news';

    /** @var array $timestamps */
    public $timestamps = ['created_at', 'updated_at'];

    /** @var array $fillable */
    protected $fillable = [
        'subject',
        'content',
        'created_at',
        'views',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language()
    {
        return $this->belongsTo(Language::class, 'id');
    }
    
    public function getTitle($lang) {
        $title_list = json_decode($this->title, true);
        if (array_key_exists($lang, $title_list)){
            return $title_list[$lang];
        }else{
            return array_shift($title_list);
        }
    }
    
    public function getShortContent($lang) {
        $title_list = json_decode($this->short_content, true);
        if (array_key_exists($lang, $title_list)){
            return $title_list[$lang];
        }else{
            return array_shift($title_list);
        }
    }
    
    public function getContent($lang) {
        $title_list = json_decode($this->content, true);
        if (array_key_exists($lang, $title_list)){
            return $title_list[$lang];
        }else{
            return array_shift($title_list);
        }
    }
}