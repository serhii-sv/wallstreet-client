<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DeviceStat
 *
 * @property int $id
 * @property string $browser
 * @property int $count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceStat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceStat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceStat query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceStat whereBrowser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceStat whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceStat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceStat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceStat whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DeviceStat extends Model
{
    use HasFactory;
    protected $guarded = ['_token'];
}
