<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class ProductCategory extends Model
{
    use CrudTrait;
    use Sluggable, SluggableScopeHelpers;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'product_categories';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['name','icon','description','color','acronym','cover_position','parent_id','status'];
    // protected $hidden = [];
    // protected $dates = [];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'acronym' => [
                'source' => 'name_or_acronym',
            ],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    
    private function getChildrenIds($childrens) {
        if ($childrens) {
            if (count($childrens)) {
                $ids = '';
                foreach ($childrens as $children) {
                    if ($ids) $ids = $ids . ',';
                    $ids = $ids . $children['id'];
                    if ($this->getChildrenIds($children['childrens']))
                        $ids = $ids . ',' . $this->getChildrenIds($children['childrens']);
                }
                return $ids;
            }
        }
    }
    
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function parent()
    {
        return $this->belongsTo('App\Models\ProductCategory');
    }

    public function children()
    {
        return $this->hasMany('App\Models\ProductCategory');
    }
    
    public function childrens()
    {
       return $this->hasMany('App\Models\ProductCategory', 'parent_id')->with('childrens');
    }
    
    public function childrensOn()
    {
       return $this->hasMany('App\Models\ProductCategory', 'parent_id')->where('status', 'PUBLISHED')->with('childrensOn');
    }
    
    public function games()
    {
        return $this->hasMany('App\Models\Game', 'category_id', 'id');
    }
    
    public function ownProductsCount()
    {
        return $this->hasOne('App\Models\Game')
            ->selectRaw('category_id, count(*) as aggregate')
            ->groupBy('category_id');
    }
    
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    
    public function scopeFirstLevelItems($query)
    {
        return $query->where('depth', '1')
                    ->orWhere('depth', null)
                    ->orderBy('lft', 'ASC');
    }
    
    public function getTreeView($query)
    {
        return $query->orderBy('lft', 'ASC')->orderBy('rgt', 'DESC');
    }
    
    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    public function productsCount()
    {
        $childrens = $this->childrens()->get();
        $children_ids = $this->getChildrenIds($childrens);
        $count = 0;
        if ($children_ids) {
            $count = count(\App\Models\Game::whereIn('category_id', explode(",", $children_ids))->get());
        }
        
        $count = $count + $this->games()->count();
        return $count;
    }
    
    /*
    |
    | Get URL
    |
    */
    public function getUrlAttribute()
    {
        return url('products/' . str_slug($this->acronym));
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    
    /*
    |
    | Get Listings count and cheapest listing for backend
    |
    */
    public function getProductsAdmin()
    {
        if ($this->productsCount() > 0) {
            return '<span class="label label-success">' . $this->productsCount() .'</span>';
        } else {
            return '<span class="label label-danger">0</span>';
        }
    }
    
    /*
    |
    | Get Listings count and cheapest listing for backend
    |
    */
    public function getHierarchyAdmin()
    {
        return [1, 2];
    }
    
    /*
    |
    | Get Listings count and cheapest listing for backend
    |
    */
    public function getFirstLevelItems()
    {
        return $this->where('depth', '1')
                    ->orWhere('depth', null)
                    ->orderBy('lft', 'ASC');
    }
}
