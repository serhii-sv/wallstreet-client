<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HttpLog extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'request_body',
        'ip',
        'user_id',
        'method',
        'request_url'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'request_body' => 'json'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $request
     * @return mixed
     */
    public static function setLog($request)
    {
        if (auth()->check()) {
            return self::create([
                'request_body' => $request->all(),
                'ip' => $request->ip(),
                'user_id' => auth()->user()->id,
                'method' => $request->method(),
                'request_url' => $request->url()
            ]);
        }
        return false;
    }
}
