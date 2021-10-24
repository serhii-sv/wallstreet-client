<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ReferralLinkStat
 *
 * @property string $id
 * @property string $partner_id
 * @property string|null $user_id
 * @property int $click_count
 * @property string $ip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralLinkStat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralLinkStat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralLinkStat query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralLinkStat whereClickCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralLinkStat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralLinkStat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralLinkStat whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralLinkStat wherePartnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralLinkStat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralLinkStat whereUserId($value)
 * @mixin \Eloquent
 */
class ReferralLinkStat extends Model
{
    use HasFactory;
    use Uuids;
    public $keyType = 'string';
    
    protected $guarded = ['_token'];
    
}
