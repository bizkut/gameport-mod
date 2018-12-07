<?php
namespace App;

trait PageTemplates
{
    /*
    |--------------------------------------------------------------------------
    | Page Templates for Backpack\PageManager
    |--------------------------------------------------------------------------
    |
    | Each page template has its own method, that define what fields should show up using the Backpack\CRUD API.
    | Use snake_case for naming and PageManager will make sure it looks pretty in the create/update form
    | template dropdown.
    |
    | Any fields defined here will show up after the standard page fields:
    | - select template
    | - page name (only seen by admins)
    | - page title
    | - page slug
    */


    private function with_subheader()
    {
        $this->crud->addField([   // CustomHTML
                        'name' => 'subheader_seperator',
                        'type' => 'custom_html',
                        'value' => '<br><h2>Subheader</h2><hr>',
                    ]);

        $this->crud->addField([
                        'name' => 'subheader_title',
                        'label' => 'Subheader Title',
                        'fake' => true,
                        'store_in' => 'extras',
                    ]);

        $this->crud->addField([
                        'name' => 'subheader_icon',
                        'label' => 'Subheader Icon',
                        'fake' => true,
                        'type' => 'icon_picker',
                        'store_in' => 'extras',
                    ]);

        $this->crud->addField([   // CustomHTML
                        'name' => 'content_separator',
                        'type' => 'custom_html',
                        'value' => '<br><h2>Content</h2><hr>',
                    ]);

        $this->crud->addField([
                        'name' => 'content',
                        'label' => 'Content',
                        'type' => 'wysiwyg',
                        'placeholder' => 'Your content here',
                    ]);

        $this->crud->addField([   // CustomHTML
                        'name' => 'metas_separator',
                        'type' => 'custom_html',
                        'value' => '<br><h2>'.trans('backpack::pagemanager.metas').'</h2><hr>',
                    ]);

        $this->crud->addField([
                        'name' => 'meta_title',
                        'label' => trans('backpack::pagemanager.meta_title'),
                        'fake' => true,
                        'store_in' => 'extras',
                        'placeholder' => 'Your content here',
                        'hint' => 'Will be automatically generated from your title, if left empty.',
                    ]);

        $this->crud->addField([
                        'name' => 'meta_description',
                        'label' => trans('backpack::pagemanager.meta_description'),
                        'fake' => true,
                        'store_in' => 'extras',
                        'hint' => 'Default meta description will be used, if left empty.',
                    ]);

    }

    private function without_subheader()
    {
        $this->crud->addField([   // CustomHTML
                        'name' => 'content_separator',
                        'type' => 'custom_html',
                        'value' => '<br><h2>Content</h2><hr>',
                    ]);

        $this->crud->addField([
                        'name' => 'content',
                        'label' => 'Content',
                        'type' => 'wysiwyg',
                        'placeholder' => 'Your content here',
                    ]);

        $this->crud->addField([   // CustomHTML
                        'name' => 'metas_separator',
                        'type' => 'custom_html',
                        'value' => '<br><h2>'.trans('backpack::pagemanager.metas').'</h2><hr>',
                    ]);

        $this->crud->addField([
                        'name' => 'meta_title',
                        'label' => trans('backpack::pagemanager.meta_title'),
                        'fake' => true,
                        'store_in' => 'extras',
                        'hint' => 'Will be automatically generated from your title, if left empty.',
                    ]);

        $this->crud->addField([
                        'name' => 'meta_description',
                        'label' => trans('backpack::pagemanager.meta_description'),
                        'fake' => true,
                        'store_in' => 'extras',
                        'hint' => 'Default meta description will be used, if left empty.',
                    ]);
    }

    private function contact_form()
    {
        $this->crud->addField([   // CustomHTML
                        'name' => 'subheader_seperator',
                        'type' => 'custom_html',
                        'value' => '<br><h2>Subheader</h2><hr>',
                    ]);

        $this->crud->addField([
                        'name' => 'subheader_title',
                        'label' => 'Subheader Title',
                        'fake' => true,
                        'store_in' => 'extras',
                    ]);

        $this->crud->addField([
                        'name' => 'subheader_icon',
                        'label' => 'Subheader Icon',
                        'fake' => true,
                        'type' => 'icon_picker',
                        'store_in' => 'extras',
                    ]);

        $this->crud->addField([   // CustomHTML
                        'name' => 'content_separator',
                        'type' => 'custom_html',
                        'value' => '<br><h2>Content above contact form</h2><hr>',
                    ]);

        $this->crud->addField([
                        'name' => 'content',
                        'label' => 'Content',
                        'type' => 'wysiwyg',
                        'placeholder' => 'Your content here',
                    ]);

        $this->crud->addField([   // CustomHTML
                        'name' => 'metas_separator',
                        'type' => 'custom_html',
                        'value' => '<br><h2>'.trans('backpack::pagemanager.metas').'</h2><hr>',
                    ]);

        $this->crud->addField([
                        'name' => 'meta_title',
                        'label' => trans('backpack::pagemanager.meta_title'),
                        'fake' => true,
                        'store_in' => 'extras',
                        'hint' => 'Will be automatically generated from your title, if left empty.',
                    ]);

        $this->crud->addField([
                        'name' => 'meta_description',
                        'label' => trans('backpack::pagemanager.meta_description'),
                        'fake' => true,
                        'store_in' => 'extras',
                        'hint' => 'Default meta description will be used, if left empty.',
                    ]);
    }
}
