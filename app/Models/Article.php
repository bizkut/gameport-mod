<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Article extends Model
{
    use CrudTrait;
    use Sluggable, SluggableScopeHelpers;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'articles';
    protected $primaryKey = 'id';
    public $timestamps = true;
    // protected $guarded = ['id'];
    protected $fillable = ['slug', 'title', 'content', 'image', 'status', 'category_id', 'featured', 'date'];
    // protected $hidden = [];
    // protected $dates = [];
    protected $casts = [
        'featured'  => 'boolean',
        'date'      => 'date',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'slug_or_title',
            ],
        ];
    }

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

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'article_tag');
    }

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

    // The slug is created automatically from the "title" field if no slug exists.
    public function getSlugOrTitleAttribute()
    {
        if ($this->slug != '') {
            return $this->slug;
        }

        return $this->title;
    }

    /*
    |
    | Save image to database
    |
    */
    public function setImageAttribute($value)
    {
        $attribute_name = 'image';
        $disk = 'local';
        $destination_path = 'public/articles';

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
              \Storage::disk($disk)->delete('/public/articles/' . $this->image);
          }

          // 3. Save the path to the database
          $this->attributes[$attribute_name] = $filename;
          // if string was sent
        }
    }

    /*
    |
    | Get URL
    |
    */
    public function getUrlSlugAttribute()
    {
        return url('blog/' . str_slug($this->slug) . '-' . $this->id);
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

    /*
    |
    | Return "Open Blog" Button for admin panel
    |
    */
    public function openBlog($crud = false)
    {
        return '<a class="btn btn-xs btn-default" target="_blank" href="' . $this->url_slug . '"><i class="fa fa-newspaper-o"></i> Open Article</a>';
    }
}
