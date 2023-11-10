<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Permission;
use App\Http\Requests\CardealerRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CardealerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CardealerCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Cardealer::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/cardealer');
        CRUD::setEntityNameStrings('cardealer', 'cardealers');
        Permission::adminOnly();
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // CRUD::column('user_id')->label('Eigenaar');
        // get the name of owner
        CRUD::addColumn([
            'name' => 'user_id',
            'type' => 'select',
            'label' => 'Eigenaar',
            'entity' => 'user',
            'attribute' => 'name',
            'model' => "App\Models\User",
        ]);

        CRUD::column('name')->label('Naam');
        CRUD::column('postal_code')->label('Postcode');
        CRUD::column('primary_color')->label('Primaire kleur')->type('color');
        CRUD::column('secondary_color')->label('Secundaire kleur')->type('color');

        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CardealerRequest::class);
        CRUD::field('name');
        CRUD::field('postal_code');
        CRUD::field('primary_color')->type('color');
        CRUD::field('secondary_color')->type('color');

        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
