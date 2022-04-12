<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\InfoMenu;
use App\Models\Menu;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Nette\Schema\ValidationException;

class InfoMenuController extends Controller
{
    public function index() : JsonResponse
    {
        try {
            $data = InfoMenu::latest()->get();
            return response()->json([
                "data" => $data
            ]);
        } catch (QueryException $e) {
            return response()->json([
                "message" => $e
            ]);
        }
    }

    public function show(Menu $menu) {
        try {
            $infoMenu = $menu->info_menu()->get();
            return response()->json([
                "nama_menu" => $menu['name'],
                "data" => $infoMenu
            ]);
        }catch (QueryException $e) {
            return response()->json([
                "error" => $e
            ]);
        }
    }

    public function store(Request $request, Menu $menu) {
        try {
            $data = $request->validate([
                "description" => 'required',
                "image" => 'required',
                "info" => 'required',
            ]);
        }catch (ValidationException $e) {
            return response()->json([
                "error" => $e
            ]);
        }

        try {
            $created_menu = $menu->info_menu()->create($data);
            return response()->json([
                "data" => $created_menu
            ]);
        } catch (QueryException $e) {
            return response()->json([
                "error" => $e
            ]);
        }
    }

    public function delete(InfoMenu $infoMenu) {
        try {
            $infoMenu->delete();
            return response()->json([
                "message" => "successfully deleted"
            ]);
        } catch (QueryException $e) {
            return response()->json([
                "error" => $e
            ]);
        }
    }
}
