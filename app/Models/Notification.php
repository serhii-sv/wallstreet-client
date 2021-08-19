<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    private $types = [
        1 => [
            'name' => 'Email',
            'active' => true
        ],
        2 => [
            'name' => 'Браузер',
            'active' => true
        ],
        3 => [
            'name' => 'Смс',
            'active' => false
        ]
    ];
    
    protected $guarded = ['_token'];
    
    public function getTypes():array {
        return $this->types;
    }
}
