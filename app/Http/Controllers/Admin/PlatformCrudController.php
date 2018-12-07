<?php
namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\PlatformRequest as StoreRequest;
use App\Http\Requests\PlatformRequest as UpdateRequest;

class PlatformCrudController extends CrudController
{
    public function setUp()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel("App\Models\Platform");
        $this->crud->setRoute("admin/platform");
        $this->crud->setEntityNameStrings('platform', 'platforms');
        $this->crud->enableAjaxTable();

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        //$this->crud->setFromDb();



        // ------ CRUD FIELDS
        $this->crud->addField(['name'  => 'name', 'attributes' => ['required' => 'required']]);
        $this->crud->addField(['name'  => 'acronym', 'attributes' => ['required' => 'required']]);
        $this->crud->addField(['name'  => 'description', 'type' => 'summernote']);
        $this->crud->addField(['name'  => 'color', 'label' => 'Color', 'type' => 'color_picker', 'attributes' => ['required' => 'required']]);
        $this->crud->addField(['name'  => 'cover_position', 'label' => 'Cover position', 'type' => 'enum']);
        $this->crud->addField([       // Select2Multiple = n-n relationship (with pivot table)
            'label' => "Digital distributors",
            'type' => 'select2_multiple',
            'name' => 'digitals', // the method that defines the relationship in your Model
            'entity' => 'digitals', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Digital", // foreign key model
            'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
        ]);

        // ------ CRUD COLUMNS
        $this->crud->addColumn(['name' => 'name']);
        $this->crud->addColumn(['name' => 'acronym']);
        $this->crud->addColumn(['name' => 'color','type' => 'color']);
        $this->crud->addColumn(['name' => 'id', 'label' => 'Games', 'type' => 'model_function','function_name' => 'getGamesAdmin' ]);
        $this->crud->addColumn([
         // n-n relationship (with pivot table)
            'label' => "Digital distributors", // Table column heading
            'type' => "select_multiple",
            'name' => 'digitals', // the method that defines the relationship in your Model
            'entity' => 'digitals', // the method that defines the relationship in your Model
            'attribute' => "name", // foreign key attribute that is shown to user
            'model' => "App\Models\Digital", // foreign key model
        ]);

        // ------ CRUD BUTTONS
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        // $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
        // $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);

        // ------ CRUD ACCESS
        // $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);
        // $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete']);

        // ------ CRUD REORDER
        // $this->crud->enableReorder('label_name', MAX_TREE_LEVEL);
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('reorder');

        // ------ CRUD DETAILS ROW
        // $this->crud->enableDetailsRow();
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('details_row');
        // NOTE: you also need to do overwrite the showDetailsRow($id) method in your EntityCrudController to show whatever you'd like in the details row OR overwrite the views/backpack/crud/details_row.blade.php

        // ------ REVISIONS
        // You also need to use \Venturecraft\Revisionable\RevisionableTrait;
        // Please check out: https://laravel-backpack.readme.io/docs/crud#revisions
        // $this->crud->allowAccess('revisions');

        // ------ AJAX TABLE VIEW
        // Please note the drawbacks of this though:
        // - 1-n and n-n columns are not searchable
        // - date and datetime columns won't be sortable anymore
        // $this->crud->enableAjaxTable();


        // ------ DATATABLE EXPORT BUTTONS
        // Show export to PDF, CSV, XLS and Print buttons on the table view.
        // Does not work well with AJAX datatables.
        // $this->crud->enableExportButtons();

        // ------ ADVANCED QUERIES
        // $this->crud->addClause('active');
        // $this->crud->addClause('type', 'car');
        // $this->crud->addClause('where', 'name', '==', 'car');
        // $this->crud->addClause('whereName', 'car');
        // $this->crud->addClause('whereHas', 'posts', function($query) {
        //     $query->activePosts();
        // });
        // $this->crud->orderBy();
        // $this->crud->groupBy();
        // $this->crud->limit();
    }

    public function store(StoreRequest $request)
    {
        return parent::storeCrud();
    }

    public function update(UpdateRequest $request)
    {
        return parent::updateCrud();
    }
}
