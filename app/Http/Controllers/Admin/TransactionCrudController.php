<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\TransactionRequest as StoreRequest;
use App\Http\Requests\TransactionRequest as UpdateRequest;

class TransactionCrudController extends CrudController
{

    public function setUp()
    {

        /*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/
        $this->crud->setModel("App\Models\Transaction");
        $this->crud->setRoute("admin/transaction");
        $this->crud->setEntityNameStrings('transaction', 'transactions');

        /*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'sale',
            'label'=> 'Sale'
        ], false, function ($values) { // if the filter is active
            $this->crud->addClause('where', 'type', 'sale');
        });

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'fee',
            'label'=> 'Fee'
        ], false, function ($values) { // if the filter is active
            $this->crud->addClause('where', 'type', 'fee');
        });

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'withdrawal',
            'label'=> 'Withdrawal'
        ], false, function ($values) { // if the filter is active
            $this->crud->addClause('where', 'type', 'withdrawal');
        });

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'purchase',
            'label'=> 'Purchase'
        ], false, function ($values) { // if the filter is active
            $this->crud->addClause('where', 'type', 'purchase');
        });

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'refund',
            'label'=> 'Refund'
        ], false, function ($values) { // if the filter is active
            $this->crud->addClause('where', 'type', 'refund');
        });

        // ------ CRUD COLUMNS
        $this->crud->addColumn(['name' => 'type', 'label' => 'Type', 'type' => 'model_function','function_name' => 'getTypeAdmin']);
        $this->crud->addColumn(['name' => 'total', 'label' => 'Total', 'type' => 'model_function','function_name' => 'getAmountAdmin']);
        $this->crud->addColumn(['name' => 'user_id', 'label' => 'User', 'type' => 'model_function','function_name' => 'getUserAdmin']);
        $this->crud->addColumn(['name' => 'item_id', 'label' => 'Details', 'type' => 'model_function','function_name' => 'getItemAdmin']);
        $this->crud->addColumn(['name' => 'created_at', 'label' => 'Created', 'type' => 'model_function','function_name' => 'getDateAdmin']);



        // ------ CRUD BUTTONS
        $this->crud->removeAllButtonsFromStack('line');
        $this->crud->removeButton('create');
        $this->crud->removeButton('delete');
        $this->crud->removeButton('update');

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
