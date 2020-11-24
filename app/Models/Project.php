<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Project extends Model
{
    protected $collection = 'projects';
    protected $primaryKey = '_id';
    protected $fillable = ['title'];
    public $timestamps = false;
}
