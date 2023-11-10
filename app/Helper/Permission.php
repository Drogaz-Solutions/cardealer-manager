<?php

namespace App\Helper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class Permission extends Controller
{
    public static function adminOnly() {
        if(!backpack_user()->is_admin) {
            return CRUD::denyAccess(['create', 'delete', 'show', 'update', 'list']);
        }
    }
}
