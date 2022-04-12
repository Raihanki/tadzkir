<?php

namespace App\Http\Controllers\Dzikir;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Dzikir;
use App\Models\Menu;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DzikirController extends Controller
{
    public function index() : JsonResponse
    {
        try {
            $data = Dzikir::latest()->get();
            return response()->json([
                "data" => $data
            ]);
        } catch (QueryException $e) {
            return response()->json([
                "error" => $e
            ]);
        }
    }

    public function showByCategory(Category $category) {
        try {
            $data = Dzikir::where('category', $category->id)->get();
            return response()->json([
                "data" => $data
            ]);
        } catch (QueryException $e) {
            return response()->json([
                "error" => $e
            ]);
        }
    }

    public function showByMenu(Menu $menu) {
        try {
            $data = $menu->dzikirs()->latest()->get();
            return response()->json([
                "data" => $data
            ]);
        } catch (QueryException $e) {
            return response()->json([
                "error" => $e
            ]);
        }
    }

    public function createNewDzikir(Request $request, Menu $menu) {
        $data = $request->validate([
            "title" => ['required'],
            "long_title" => ["required"],
            "description" => ["required"],
            "categories" => ["required"],
            "doa_latin" => ["required"],
            "doa_arab" => ["required"],
            "description_doa" => ["required"]
        ]);

        try {
            $cat = Category::where("slug", $data["categories"])->first();
            if (!$cat) {
                return response()->json([
                    "message" => "Category Tidak Ditemukan"
                ]);
            }
            $data["categories"] = $cat->id;
            $createdData = $menu->dzikirs()->create($data);
            return response()->json([
                "data" => $createdData
            ]);
        } catch (QueryException $e) {
            return response()->json([
                "error" => $e
            ]);
        }

    }

    public function deleteDzikir($dzikirId) {
        try {
            $dzikir = Dzikir::findOrFail($dzikirId);
            $dzikir->delete();
            return response()->json([
                "message" => "Successfully deleted"
            ]);
        } catch (QueryException $e) {
            return response()->json([
                "error" => $e
            ]);
        }
    }
}
