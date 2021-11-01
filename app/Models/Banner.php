<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Banner
 *
 * @property string $id
 * @property string $title
 * @property string|null $image
 * @property string $size
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Banner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Banner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Banner query()
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Banner extends Model
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
     * Size constants
     */
    const MEDIUM_RECTANGLE = 'Medium Rectangle';
    const LEADERBOARD = 'Leaderboard';
    const WIDE_SKYSCRAPER = 'Wide Skyscraper';
    const HALF_PAGE = 'Half Page';
    const BILLBOARD = 'Billboard';
    const LARGE_RECTANGLE = 'Large Rectangle';
    const BANNER = 'Banner';
    const SKYSCRAPER = 'Skyscraper';
    const HALF_BANNER = 'Half Banner';
    const VERTICAL_BANNER = 'Vertical Banner';
    const LARGE_LEADERBOARD = 'Large Leaderboard';
    const PORTRAIT = 'Portrait';
    const SQUARE = 'Square';
    const SMALL_SQUARE = 'Small Square';
    const SMALL_RECTANGLE = 'Small Rectangle';
    const BUTTON = 'Button';
    const CUSTOM = 'Custom';

    /**
     * Sizes list
     */
    const BANNERS = [
        self::MEDIUM_RECTANGLE => [
            'name' => 'Средний прямоугольник',
            'size' => '300×250',
            'image' => 'MEDIUM_RECTANGLE.jpeg'
        ],
        self::LEADERBOARD => [
            'name' => 'Рейтинг',
            'size' => '728×90',
            'image' => 'LEADERBOARD.jpeg'
        ],
        self::WIDE_SKYSCRAPER => [
            'name' => 'Широкий небоскреб',
            'size' => '160×600',
            'image' => 'WIDE_SKYSCRAPER.jpeg'
        ],
        self::HALF_PAGE => [
            'name' => 'Половина страницы',
            'size' => '300×600',
            'image' => 'HALF_PAGE.jpeg'
        ],
        self::BILLBOARD => [
            'name' => 'Рекламный щит',
            'size' => '970×250',
            'image' => 'BILLBOARD.jpeg'
        ],
        self::LARGE_RECTANGLE => [
            'name' => 'Большой прямоугольник',
            'size' => '336×280',
            'image' => 'LARGE_RECTANGLE.jpeg'
        ],
        self::BANNER => [
            'name' => 'Баннер',
            'size' => '468×60',
            'image' => 'BANNER.jpeg'
        ],
        self::HALF_BANNER => [
            'name' => 'Половина баннера',
            'size' => '234×60',
            'image' => 'HALF_BANNER.jpeg'
        ],
        self::SKYSCRAPER => [
            'name' => 'Skyscraper',
            'size' => '120×600',
            'image' => 'SKYSCRAPER.jpeg'
        ],
        self::VERTICAL_BANNER => [
            'name' => 'Вертикальный баннер',
            'size' => '120×240',
            'image' => 'VERTICAL_BANNER.jpeg'
        ],
        self::LARGE_LEADERBOARD => [
            'name' => 'Большой рейтинг',
            'size' => '970×90',
            'image' => 'LARGE_LEADERBOARD.jpeg'
        ],
        self::PORTRAIT => [
            'name' => 'Портрет',
            'size' => '300×1050',
            'image' => 'PORTRAIT.jpeg'
        ],
        self::SQUARE => [
            'name' => 'Квадрат',
            'size' => '250×250',
            'image' => 'SQUARE.jpeg'
        ],
        self::SMALL_SQUARE => [
            'name' => 'Малый квадрат',
            'size' => '200×200',
            'image' => 'SMALL_SQUARE.jpeg'
        ],
        self::SMALL_RECTANGLE => [
            'name' => 'Малый прямоугольник',
            'size' => '180×150',
            'image' => 'SMALL_RECTANGLE.jpeg'
        ],
        self::BUTTON => [
            'name' => 'Кнопка',
            'size' => '125×125',
            'image' => 'BUTTON.jpeg'
        ],
        self::CUSTOM => [
            'name' => 'Авто',
            'size' => 'Свой размер',
            'image' => 'BUTTON.jpeg'
        ],
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'image',
        'size'
    ];

    /**
     * @param $size
     * @return string|null
     */
    public static function getBannerImage($size)
    {
        foreach (self::BANNERS as $BANNER) {
            if ($BANNER['size'] == $size) {
                return $BANNER['image'];
            }
        }
        return null;
    }

    public function getWidth() {
        if(preg_match('/[\d]+x[\d]+/', $this->size)){
            $size = explode('×',$this->size);
            return $size[0];
        }
        return false;
    }
    public function getHeight() {
        if(preg_match('/[\d]+x[\d]+/', $this->size)){
            $size = explode('×',$this->size);
            return $size[1];
        }
        return false;
    }
}
