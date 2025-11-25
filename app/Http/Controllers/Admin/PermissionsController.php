<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PermissionsController extends Controller
{
    /**
     * Display view to listing of the resource.
     */
    public function index() {
        return view('admin.permissions');
    }

}
