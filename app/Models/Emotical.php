<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Emotical extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'emoticals';
    protected $primaryKey = 'id';
    public $timestamps = true;
    // protected $guarded = ['id'];
    protected $fillable = ['string', 'description', 'image', 'status'];
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

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopePublished($query)
    {
        return $query->where('status', 'PUBLISHED')
                    ->where('date', '<=', date('Y-m-d'))
                    ->orderBy('date', 'DESC');
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */


    /*
    |
    | Save image to database
    |
    */
    public function setImageAttribute($value)
    {
        $attribute_name = 'image';
        $disk = 'local';
        $destination_path = 'public/emoticals';

        // if a base64 was sent, store it in the db
        if (starts_with($value, 'data:image')) {
            // 0. Make the image
          $image = \Image::make($value);
          // 1. Generate a filename.
          $filename = time().'-'.$this->id.'.jpg';
          // 2. Store the image on disk.
          \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());

          // Delete old image
          if (!is_null($this->image)) {
              \Storage::disk($disk)->delete('/public/emoticals/' . $this->image);
          }

          // 3. Save the path to the database
          $this->attributes[$attribute_name] = $filename;
          // if string was sent
        }
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    /*
    |
    | Get Image
    |
    */
    public function getImageAttribute($value)
    {
        if (!is_null($value)) {
            return asset('images/original/' . $value);
        } else {
            return asset('images/original/no_cover.jpg');
        }
    }

    /*
    |
    | Get Square (Tiny) Image
    |
    */
    public function getImageSquareTinyAttribute()
    {
        if (!is_null($this->attributes['image'])) {
            return asset('images/square_tiny/' . $this->attributes['image']);
        } else {
            return asset('images/square_tiny/no_cover.jpg');
        }
    }

    /*
    |
    | Get Square (Tiny) Image
    |
    */
    public function getImageLargeAttribute()
    {
        if (!is_null($this->attributes['image'])) {
            return asset('images/large/' . $this->attributes['image']);
        } else {
            return asset('images/large/no_cover.jpg');
        }
    }

}
