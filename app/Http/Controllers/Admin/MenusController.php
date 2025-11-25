<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index() {
        try {
            $menus = Menu::with(['pages'])->latest('id')->get();
        
            return response([
                'menus' => $menus,
                'message' => 'Get all rows successfully.'
            ]);
        } catch (\Throwable $th) {
            return response([
                'error' => $th->getMessage(),
                'message' => 'Message example.'
            ],500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $menu = Menu::create([
                'name' => $request->name,
            ]);

            $menu->pages()->sync($request->pages);

            return response([
                'menu' => $menu->load('pages'),
                'message' => 'Created menu successfully.'
            ]);

        } catch (\Throwable $th) {
            return response([
                'error' => $th->getMessage(),
                'message' => 'Error created menu.'
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu) {
        try {
            return response();
        } catch (\Throwable $th) {
            return response([
                'error' => $th->getMessage(),
                'message' => 'Message example.'
            ],500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu) {
         $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            
            $menu->name = $request->name;
            $menu->save();

            $menu->pages()->sync($request->pages);

            return response([
                'menu' => $menu,
                'message' => 'menu updated successfully.'
            ]);

        } catch (\Throwable $th) {
            return response([
                'error' => $th->getMessage(),
                'message' => 'Error updated menu.'
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu) {
        try {
            $menu->pages()->sync([]);
            $menu->delete();
            return response([
                'menu' => $menu,
                'message' => 'Deleted menu successfully.'
            ]);
        } catch (\Throwable $th) {
            return response([
                'error' => $th->getMessage(),
                'message' => 'Error deleted menu'
            ],500);
        }
    }
}
