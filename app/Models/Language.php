<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Language extends Model
{
    use CrudTrait;

    protected $table = 'languages';

    protected $fillable = ['name', 'flag', 'abbr', 'native', 'active', 'default'];

    public $timestamps = false;

    public static function getActiveLanguagesArray()
    {
        $active_languages = self::where('active', 1)->get()->toArray();
        $localizable_languages_array = [];

        if (isset($active_languages) && count($active_languages)) {
            foreach ($active_languages as $key => $lang) {
                $localizable_languages_array[$lang['abbr']] = $lang;
            }

            return $localizable_languages_array;
        }

        return config('laravellocalization.supportedLocales');
    }

    public static function findByAbbr($abbr = false)
    {
        return self::where('abbr', $abbr)->first();
    }
}
