<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolAdministrator extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'schools_administrators';

    protected $primaryKey = 'id'; //table primary key

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}
