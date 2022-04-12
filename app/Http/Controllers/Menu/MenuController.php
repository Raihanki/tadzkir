<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class MenuController extends Controller
{
    public function index() : JsonResponse
    {
        try {
            $menus = Menu::latest()->get();
            return response()->json([
                "data" => $menus
            ]);
        } catch (QueryException $e) {
            return response()->json([
                "error" => $e
            ]);
        }
    }

    public function store(MenuRequest $request) : JsonResponse
    {
        try {
            $data = $request->validated();
        } catch (ValidationException $e) {
            return response()->json([
                "error" => $e
            ]);
        }
        try {
            $data['slug'] = Str::slug($data['name'] . '-' . Str::random(6));
            $createdMenu = Menu::create($data);
            return response()->json([
                "data" => $createdMenu
            ]);
        } catch (QueryException $e) {
            return response()->json([
                "error" => $e
            ]);
        }
    }
}
