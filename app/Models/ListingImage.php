<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class ListingImage extends Model
{
    use CrudTrait;

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'listing_images';
    protected $primaryKey = 'id';
    protected $appends = ['thumbnail'];
    // public $timestamps = false;
    // protected $guarded = ['id'];
    // protected $fillable = ['name'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function listing()
    {
        return $this->belongsTo('App\Models\Listing');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |
    | Get Thumbnail
    |
    */
    public function getThumbnailAttribute()
    {
        return url('images/avatar_square/' . $this->filename);
    }

    /*
    |
    | Get URL
    |
    */
    public function getUrlAttribute()
    {
        return url('images/picture/' . $this->filename);
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
