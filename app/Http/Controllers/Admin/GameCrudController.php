<?php
namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\GameRequest as StoreRequest;
use App\Http\Requests\GameRequest as UpdateRequest;

class GameCrudController extends CrudController
{
    public function setUp()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel("App\Models\Game");
        $this->crud->setRoute("admin/game");
        $this->crud->setEntityNameStrings('game', 'games');
        $this->crud->enableAjaxTable();

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        //$this->crud->setFromDb();

        $this->crud->addField(['name'  => 'name' ,'attributes' => ['required' => 'required']]);
        $this->crud->addField(['name'  => 'description', 'type' => 'summernote']);

        $this->crud->addField(['name'  => 'cover_generator', 'label' => 'Enable cover generator', 'type' => 'toggle', 'hint' => 'Add platform bar with logo on top of game cover.']);

        $this->crud->addField(['name'  => 'cover', 'type'  => 'image_generator' ,
    'upload' => true,
    'crop' => true ]);


        $this->crud->addField(['name'  => 'release_date','type' => 'date_picker', 'attributes' => ['required' => 'required']]);
        $this->crud->addField(['name'  => 'publisher']);
        $this->crud->addField(['name'  => 'developer']);
        $this->crud->addField(['name'  => 'pegi','type'  => 'enum']);

        $this->crud->addField(['label' => "Platform", 'type' => 'select2', 'name' => 'platform_id', 'entity' => 'platform', 'attribute' => 'name', 'model' => "App\Models\Platform" ]);
        $this->crud->addField(['label' => "Genre", 'type' => 'select2', 'name' => 'genre_id', 'entity' => 'genre', 'attribute' => 'name', 'model' => "App\Models\Genre" ]);

        $this->crud->addColumn(['name' => 'game_name', 'type' => 'model_function','function_name' => 'getNameAdmin',
        'searchLogic' => function ($query, $column, $searchTerm) {
              $query->orWhere('name', 'like', '%'.$searchTerm.'%');
          }
        ]);
        $this->crud->addColumn(['name' => 'platform_id','type' => 'model_function','function_name' => 'getConsoleAdmin']);
        $this->crud->addColumn(['name' => 'publisher']);
        $this->crud->addColumn(['name' => 'active_listings', 'label' => 'Active Listings', 'type' => 'model_function','function_name' => 'getListingsAdmin']);


        $this->crud->addButtonFromView('top', 'add', 'create_game', 'beginning');
        // ------ CRUD FIELDS
        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

        // ------ CRUD COLUMNS
        // $this->crud->addColumn(); // add a single column, at the end of the stack
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

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
