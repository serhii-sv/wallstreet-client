<?php

namespace App\Models;

use App\Traits\Uuids;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ActivityLog
 *
 * @property string $id
 * @property string $user_id
 * @property int $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLog whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLog whereValue($value)
 * @mixin \Eloquent
 */
class ActivityLog extends Model
{
    use HasFactory;
    use Uuids;

    /**
     * @var string
     */
    public $keyType = 'string';
    /** @var bool $incrementing */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $table = 'activity_log';

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'value'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     *
     */
    public static function setActivityLog()
    {
        $user = auth()->user();
        $activities = $user->activities;

        if (!$activities->count()) {
            $user->activities()->create([
                'value' => 0
            ]);
        } else {
            $lastActivity = $activities->last();
            $differenceInSeconds = $lastActivity->updated_at->diffInSeconds(Carbon::now());

            $now = Carbon::now()->format('H');
            if ($now !== $lastActivity->updated_at->format('H') && $now !== $lastActivity->created_at->format('H')) {
                $user->activities()->create([
                    'value' => 0
                ]);
                return;
            }

            if ($differenceInSeconds <= 300) {
                $lastActivity->update([
                    'value' => $lastActivity->value + $differenceInSeconds
                ]);
            } else {
                $lastActivity->update([
                    'value' => $lastActivity->value + 0
                ]);
            }
        }
    }

    /**
     * @param null $user
     * @param null $period
     * @param null $from
     * @param null $to
     * @return array
     */
    public static function getActivityLog($user = null, $period = null, $from = null, $to = null)
    {
        $user = $user ?? auth()->user();

        if (!is_null($from) && !is_null($to)) {

            $from = Carbon::parse($from);
            $to = $to !== 'Invalid date' ? Carbon::parse($to) : $from->format('Y-m-d 23:59:59');

            $activityTime = $user->activities()
                ->where('created_at', '>=', $from)
                ->where('created_at', '<=', $to )
                ->sum('value');
        } else {
            if (is_null($period) || $period == 'day') {
                $fromDate = date('Y-m-d 00:00:00');
            } else {
                $fromDate = date('Y-m-d 00:00:00', strtotime('- 1 ' . $period));
            }

            $activityTime = $user->activities()->where('created_at', '>=', $fromDate)->sum('value');
        }

        $dtF = new \DateTime('@0');
        $dtT = new \DateTime("@$activityTime");
        list($days, $hours, $minutes) = explode(',', $dtF->diff($dtT)->format('%a,%h,%i'));

        return [
            'time' => (($days * 24) + $hours) . ' ч ' . $minutes . ' м',
            'percentage' => self::getTimePercentage($activityTime, $period)
        ];
    }

    /**
     * @param $time
     * @param $period
     * @return float|int
     */
    public static function getTimePercentage($time, $period)
    {
        if (is_null($period) || $period == 'day') {
            return ($time / self::hoursToSeconds(24)) * 100;
        }
        if ($period == 'week') {
            return ($time / self::hoursToSeconds(7 * 24)) * 100;
        }
        if ($period == 'month') {
            return ($time / self::hoursToSeconds(30 * 24)) * 100;
        }
        return 0;
    }

    /**
     * @param $hours
     * @return float|int
     */
    public static function hoursToSeconds($hours)
    {
        return $hours * 60 * 60;
    }
}
