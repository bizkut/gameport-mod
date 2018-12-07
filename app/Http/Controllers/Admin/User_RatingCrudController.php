<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\User_RatingRequest as StoreRequest;
use App\Http\Requests\User_RatingRequest as UpdateRequest;

class User_RatingCrudController extends CrudController
{
    public function setUp()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel("App\Models\User_Rating");
        $this->crud->setRoute("admin/rating");
        $this->crud->setEntityNameStrings('rating', 'ratings');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'active',
            'label'=> 'Active'
        ], false, function ($values) { // if the filter is active
            $this->crud->query = $this->crud->query->where('active','1');
        });

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'pending',
            'label'=> 'Pending'
        ], false, function ($values) { // if the filter is active
            $this->crud->query = $this->crud->query->where('active','0');
        });

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'negative',
            'label'=> 'Negative'
        ], false, function ($values) { // if the filter is active
            $this->crud->query = $this->crud->query->where('rating','0');
        });

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'neutral',
            'label'=> 'Neutral'
        ], false, function ($values) { // if the filter is active
            $this->crud->query = $this->crud->query->where('rating','1');
        });

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'positive',
            'label'=> 'Positive'
        ], false, function ($values) { // if the filter is active
            $this->crud->query = $this->crud->query->where('rating','2');
        });

        // ------ CRUD FIELDS
        $this->crud->addField([ // select_from_array
            'name' => 'active',
            'label' => "Change Status",
            'type' => 'select_from_array',
            'options' => [0 => 'Pending', 1 => 'Active'],
            'allows_null' => false,
        ], 'update');

        $this->crud->removeButton('create');
        $this->crud->removeButton('delete');
        $this->crud->addButtonFromView('line', 'show', 'show_rating', 'ending');

        // ------ CRUD COLUMNS
        $this->crud->addColumn(['name' => 'status', 'label' => 'Status', 'type' => 'model_function','function_name' => 'getStatusAdmin']);

        $this->crud->addColumn(['name' => 'user_id_from', 'label' => 'From User', 'type' => 'model_function','function_name' => 'getUserAdmin']);

        $this->crud->addColumn(['name' => 'user_id_from', 'label' => 'To User', 'type' => 'model_function','function_name' => 'getUserToAdmin']);

        $this->crud->addColumn(['name' => 'rating', 'label' => 'Rating', 'type' => 'model_function','function_name' => 'getRatingAdmin']);

        $this->crud->addColumn(['name' => 'notice', 'label' => 'Notice', 'type' => 'text']);

        $this->crud->addColumn(['name' => 'created_at', 'label' => 'Created', 'type' => 'model_function','function_name' => 'getDateAdmin']);

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
        $this->crud->enableAjaxTable();


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
        // $this->crud->with(); // eager load relationships
        // $this->crud->orderBy();
        // $this->crud->groupBy();
        // $this->crud->limit();
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud();
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud();
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
