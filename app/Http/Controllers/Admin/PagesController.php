<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index() {
        return view('admin.pages');
    }

    public function getParents() {
        try {
            $parents = Page::where('type','parent')
                ->where('state',1)
                ->get()
                ->map(function($parent){
                    return [
                        'label' => $parent->label,
                        'value' => $parent->id,
                    ];
                });
            return response($parents);
        } catch (\Throwable $th) {
            return response([
                'error' => $th->getMessage(),
                'message' => 'Error loader parents.'
            ],500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'label' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'route' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:1',
            'page_id' => 'required|integer|exists:pages,id',
            'type' => 'required|in:header,parent,page'

        ]);

        try {
            $page = Page::create([
                'label' => $request->label,
                'icon' => $request->icon ?? 'circle',
                'route' => $request->route ?? '',
                'order' => $request->order ?? null,
                'page_id' => $request->page_id,
                'type' => $request->type,
            ]);

            return response([
                'page' => $page,
                'message' => 'Created page successfully.'
            ]);

        } catch (\Throwable $th) {
            return response([
                'error' => $th->getMessage(),
                'message' => 'Error created page.'
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page) {
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
    public function update(Request $request, Page $page) {
         $request->validate([
            'label' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'route' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:1',
            'page_id' => 'required|integer|exists:pages,id',
            'type' => 'required|in:header,parent,page'

        ]);

        try {

            $page->label = $request->label;
            $page->icon = $request->icon ?? 'circle';
            $page->route = $request->route ?? '';
            $page->order = $request->order ?? null;
            $page->page_id = $request->page_id;
            $page->type = $request->type;
            $page->save();

            return response([
                'page' => $page,
                'message' => 'Page updated successfully.'
            ]);

        } catch (\Throwable $th) {
            return response([
                'error' => $th->getMessage(),
                'message' => 'Error updated page.'
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page) {
        try {
            $page->delete();
            return response([
                'page' => $page,
                'message' => 'Deleted page successfully.'
            ]);
        } catch (\Throwable $th) {
            return response([
                'error' => $th->getMessage(),
                'message' => 'Error deleted page'
            ],500);
        }
    }
}
