<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|JsonResponse
    {
        $filters = $request->query('filter');
        $paginate = $request->query('paginate') ?? 3;
        $query = Product::query();
        $query->paginate($paginate);
        if(!is_null($filters)){
            if(array_key_exists('categories', $filters)){
                $query = $query->whereIn('category_id', $filters['categories']);
            }
            if(!is_null($filters['price_min'])){
                $query = $query->where('price', '>=', $filters['price_min']);
            }
            if(!is_null($filters['price_max'])){
                $query = $query->where('price', '<=', $filters['price_max']);
            }

            return response()->json([
                'data' => $query->get()
            ]);
        }

        return view('welcome', [
            'products' => $query->get(),
            'categories' => ProductCategory::orderBy('name', 'ASC')->get(),
            'defaultImage' => config('shop.defaultImage'),
            'isGuest' => Auth::guest()
        ]);
    }
}
