<?php

namespace App\Http\Controllers\Admin;

use Backpack\Settings\app\Models\Setting as Setting;

use Illuminate\Http\Request;
use Theme;

class SettingsController
{
    public function index()
    {
        $this->data['title'] = trans('backpack::base.dashboard'); // set the page title
        $this->data['settings'] = Setting::where('category', 'general')->get();

        return view('backpack::setting', $this->data);
    }

    public function show($category)
    {
        $this->data['title'] = 'Settings'; // set the page title
        $this->data['subtitle'] = ucfirst($category) . ' Settings'; // set the page title
        $this->data['settings'] = Setting::where('category', $category)->orderBy('reorder')->get();
        $this->data['category'] = $category;

        return view('backpack::setting', $this->data);
    }

    public function theme()
    {
        $this->data['title'] = 'Theme Settings'; // set the page title
        $this->data['subtitle'] = ucfirst('test') . ' Settings'; // set the page title
        $this->data['settings'] = Setting::where('category', 'test')->orderBy('reorder')->get();
        $this->data['category'] = 'test';
        $this->data['themes'] = Theme::all();

        return view('backpack::theme', $this->data);
    }

    public function setDefaultTheme($theme)
    {
        // check if theme saved
        $theme_saved = false;
        // get all themes
        $themes = Theme::all();
        // get theme setting
        $setting = Setting::where('key', 'default_theme')->first();

        // check if theme exist and change setting
        foreach ($themes as $theme_check) {
            if ($theme_check['slug'] === $theme) {
                if ($theme_check['public']) {
                    $setting->value = $theme;
                    $setting->save();
                    $theme_saved = true;
                } else {
                    \Alert::error(ucfirst($theme) . ' Theme not public!')->flash();
                    return redirect()->action('Admin\SettingsController@theme');
                }
            }
        }

        if ($theme_saved) {
            // show a success message
            \Alert::success(ucfirst($theme) . ' Theme saved as default!')->flash();
        } else {
            // show a error message
            \Alert::error(ucfirst($theme) . ' Theme not found!')->flash();
        }

      return redirect()->action('Admin\SettingsController@theme');
    }

    public function save(Request $request, $category)
    {
        $settings = Setting::where('category', $category)->get();

        foreach ($settings as $setting) {
            if ($request->input($setting->key)) {
                // *
                // *
                // Logo Upload
                // *
                // *
                if ($setting->key == 'logo') {
                    $disk = "img";
                    // Make the image
                    $image = \Image::make($request->input('logo'));

                    // Store retina
                    if ($image->height() >= 80) {
                        $image->resize(null, 80, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }

                    // Retina filename.
                    $filename_retina = 'logo@2x.png';
                    // Store the retina image on disk.
                    \Storage::disk($disk)->delete($filename_retina);
                    \Storage::disk($disk)->put($filename_retina, $image->stream());

                    // Store default logo
                    if ($image->height() >= 40) {
                        $image->resize(null, 40, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }

                    // default filename.
                    $filename_default = 'logo.png';
                    // Store the default image on disk.
                    \Storage::disk($disk)->delete($filename_default);
                    \Storage::disk($disk)->put($filename_default, $image->stream());

                // *
                // *
                // Favicon Upload
                // *
                // *
                } elseif ($setting->key == 'favicon') {
                    $disk = "img";
                    // Make the image
                    $image = \Image::make($request->input('favicon'));#

                    // Store 32x32
                    $image->resize(32, 32);

                    // Retina filename.
                    $filename_32 = 'favicon-32x32.png';
                    // Store the retina image on disk.
                    \Storage::disk($disk)->delete($filename_32);
                    \Storage::disk($disk)->put($filename_32, $image->stream());

                    // Store 16x16 logo
                    $image->resize(16, 16);

                    // default filename.
                    $filename_16 = 'favicon-16x16.png';
                    // Store the default image on disk.
                    \Storage::disk($disk)->delete($filename_16);
                    \Storage::disk($disk)->put($filename_16, $image->stream());
                // *
                // *
                // Favicon Upload
                // *
                // *
                } elseif ($setting->key == 'watermark') {
                    $disk = "img";
                    // Make the image
                    $image = \Image::make($request->input('watermark'));#

                    // Retina filename.
                    $filename = 'watermark.png';
                    // Store the retina image on disk.
                    \Storage::disk($disk)->delete($filename);
                    \Storage::disk($disk)->put($filename, $image->stream());
                } else {
                    $setting->value = $request->input($setting->key);
                    $setting->save();
                }
            } else {
                $field = json_decode($setting->field, true);
                if ($setting->value !== '' && $field['type'] === 'toggle') {
                    $setting->value = 0;
                    $setting->save();
                }else{
                    $setting->value = '';
                    $setting->save();
                }
            }
        }

        // show a success message
        \Alert::success(ucfirst($category) . ' Settings saved!')->flash();

        return redirect()->action('Admin\SettingsController@show', ['category' => $category]);
    }
}
