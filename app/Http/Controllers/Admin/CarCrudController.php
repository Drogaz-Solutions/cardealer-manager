<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CarRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CarCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CarCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Car::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/car');
        CRUD::setEntityNameStrings('auto', 'autos');
        
        if (!backpack_user()->is_admin) {
            CRUD::addClause('where', 'cardealer_id', backpack_user()->cardealer_id);
        }

    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // cardealer_id's name
        if(backpack_user()->is_admin) {
            CRUD::addColumn([
                'name' => 'user_id',
                'type' => 'select',
                'label' => 'Cardealer',
                'entity' => 'cardealer',
                'attribute' => 'name',
                'model' => "App\Models\Cardealer",
            ]);
        }

        CRUD::column('name')->label('Naam');

        // display the seller's name
        CRUD::addColumn([
            'name' => 'seller_id',
            'type' => 'select',
            'label' => 'Verkoper',
            'entity' => 'seller',
            'attribute' => 'name',
            'model' => "App\Models\User",
        ]);

        CRUD::column('clean_price')->label('Cardealer Prijs');
        CRUD::column('buy_price')->label('Inkoop Prijs');
        

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
        CRUD::setValidation(CarRequest::class);
        
        CRUD::field('name')->label('Naam');
        CRUD::field('clean_price')->label('Cardealer Prijs');
        CRUD::field('buy_price')->label('Inkoop Prijs');
        CRUD::field('seller_id')->type('hidden')->default(backpack_user()->id);    
        CRUD::field('cardealer_id')->type('hidden')->default(backpack_user()->cardealer_id);
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
