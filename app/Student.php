<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'firstName',
        'lastName',
        'birth',
        'squad',
        'sex',
        'foreign',
        'points'
    ];

    public static function getPagination($column, $direction = 'asc', $amount = 50) {
        return self::selectRaw('*')
            ->orderBy($column, $direction)
            ->paginate($amount);
    }
}
