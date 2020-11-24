<?php

namespace App\Models;

use Carbon\Carbon;
use Jenssegers\Mongodb\Eloquent\Model;

class ProjectUser extends Model
{
    protected $collection = 'project_user';
    protected $primaryKey = '_id';
    protected $dates = ['date'];
    protected $fillable = ['project_id', 'user_id', 'hours_of_work', 'date'];
    public $timestamps = false;

    public function getMonthAttribute($value)
    {
        return Carbon::parse($this->date)->month;
    }

    public function getDayAttribute($value)
    {
        return Carbon::parse($this->date)->day;
    }

    protected $appends = ['day', 'month'];
    protected $hidden = ['date'];
}
