<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//to use softdelete
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{
    use SoftDeletes;
    /*
     * to remove mass assignment
     */

    protected $fillable=['title','content'];
    // or
    // protected $guarded=['is_admin];

    // to use softdelete
    protected $dates=['deleted_at'];
}
