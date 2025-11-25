<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return view('admin.user.index');
    }

    
    /**
     * Display the specified resource.
     */
    public function show(int $id) {
        return view('admin.user.show',compact('id'));
    }
}
