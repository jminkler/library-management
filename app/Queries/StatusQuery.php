<?php


namespace App\Queries;

use DB;

class StatusQuery
{
    public static function recent()
    {
        return DB::table('statuses')
            ->latest();
    }
}
