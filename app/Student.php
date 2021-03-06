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

    /**
     * Return paginator with selected sort order
     *
     * @param string $column
     * @param string $direction
     * @param int $amount
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getPagination($column, $direction = 'asc', $amount = 50) {
        return self::selectRaw('*')
            ->orderBy($column, $direction)
            ->paginate($amount);
    }

    /**
     * Return paginator with selected sort order for search query
     *
     * @param string $search
     * @param string $column
     * @param string $direction
     * @param int $amount
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getSearchPagination($search, $column, $direction = 'asc', $amount = 50) {
        return self::selectRaw('*')
            ->where('firstName', 'like', "%{$search}%")
            ->orWhere('lastName', 'like', "%{$search}%")
            ->orWhere('squad', 'like', "%{$search}%")
            ->orderBy($column, $direction)
            ->paginate($amount);
    }
}
