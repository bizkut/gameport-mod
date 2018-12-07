<?php
namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Requests\EmoticalRequest as StoreRequest;
use App\Http\Requests\EmoticalRequest as UpdateRequest;

class EmoticalCrudController extends CrudController
{
    public function __construct()
    {
        parent::__construct();

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel("App\Models\Emotical");
        $this->crud->setRoute(config('backpack.base.route_prefix', 'admin').'/emotical');
        $this->crud->setEntityNameStrings('emotical', 'emoticals');

        /*
        |--------------------------------------------------------------------------
        | COLUMNS AND FIELDS
        |--------------------------------------------------------------------------
        */

        // ------ CRUD COLUMNS
        $this->crud->addColumn([
                                'name' => 'string',
                                'label' => 'String',
                            ]);
        $this->crud->addColumn([
                                'name' => 'description',
                                'label' => 'Description',
                            ]);
        $this->crud->addColumn([
                                'name' => 'image',
                                'label' => 'Emotical',
                                'type' => 'image',
                            ]);
        $this->crud->addColumn([
                                'name' => 'status',
                                'label' => 'Status',
                            ]);

        // ------ CRUD FIELDS
        $this->crud->addField([    // TEXT
                                'name' => 'string',
                                'label' => 'String',
                                'type' => 'text',
                                'placeholder' => 'Emotical string here',
                            ]);
        $this->crud->addField([
                                'name' => 'description',
                                'label' => 'Description',
                                'type' => 'text',
                                'placeholder' => 'Emotical description here',
                            ]);
        $this->crud->addField([    // Image
                                'name' => 'image',
                                'label' => 'Image',
                                'type' => 'image',
                                'crop' => 'true',
                            ]);
        $this->crud->addField([    // ENUM
                                'name' => 'status',
                                'label' => 'Status',
                                'type' => 'enum',
                            ]);

        $this->crud->enableAjaxTable();
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
