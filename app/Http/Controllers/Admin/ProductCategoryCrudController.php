<?php
namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ProductCategoryRequest as StoreRequest;
use App\Http\Requests\ProductCategoryRequest as UpdateRequest;

class ProductCategoryCrudController extends CrudController
{
    public function setUp()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel("App\Models\ProductCategory");
        $this->crud->setRoute("admin/procategory");
        $this->crud->setEntityNameStrings('product category', 'product categories');
        $this->crud->enableAjaxTable();

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        
        $this->crud->allowAccess('reorder');
        $this->crud->enableReorder('name', 2);
        
        // ------ CRUD FIELDS
        $this->crud->addField(['name'  => 'name', 'attributes' => ['required' => 'required']]);
        $this->crud->addField(['name'  => 'icon']);
        $this->crud->addField(['name'  => 'description', 'type' => 'summernote']);
        $this->crud->addField(['name'  => 'color', 'label' => 'Color', 'type' => 'color']);
        $this->crud->addField(['name'  => 'acronym', 'attributes' => ['required' => 'required']]);
        $this->crud->addField(['name'  => 'cover_position', 'label' => 'Cover position', 'type' => 'enum']);
        $this->crud->addField([
                                'label' => 'Parent',
                                'type' => 'select',
                                'name' => 'parent_id',
                                'entity' => 'parent',
                                'attribute' => 'name',
                                'model' => "App\Models\ProductCategory",
                            ]);
        $this->crud->addField([
                                'name' => 'status',
                                'label' => 'Status',
                                'type' => 'enum'
                            ]);

        // ------ CRUD COLUMNS
        $this->crud->addColumn(['name' => 'name', 'label' => 'Name']);
        $this->crud->addColumn(['name' => 'icon', 'label' => 'Icon']);
        $this->crud->addColumn(['name' => 'description', 'label' => 'Description']);
        $this->crud->addColumn(['name' => 'color', 'type' => 'color', 'label' => 'Color']);
        $this->crud->addColumn(['name' => 'acronym', 'label' => 'Acronym']);
        $this->crud->addColumn([
                                'label' => 'Parent',
                                'type' => 'select',
                                'name' => 'parent_id',
                                'entity' => 'parent',
                                'attribute' => 'name',
                                'model' => "App\Models\ProductCategory",
                            ]);
        $this->crud->addColumn(['name' => 'id', 'label' => 'Products', 'type' => 'model_function','function_name' => 'getProductsAdmin' ]);
        $this->crud->addColumn(['name' => 'status', 'label' => 'Status']);

        $this->crud->orderBy('lft', 'ASC')->orderBy('rgt', 'DESC');
        
        // ------ CRUD BUTTONS

        // ------ CRUD ACCESS

        // ------ CRUD REORDER

        // ------ CRUD DETAILS ROW

        // ------ REVISIONS

        // ------ AJAX TABLE VIEW

        // ------ DATATABLE EXPORT BUTTONS

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
