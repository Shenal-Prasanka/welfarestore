<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Supply; 
use App\Models\Product; 
use App\Models\Welfare;
use App\Models\Regement;
use App\Models\Rank;
use App\Models\Unit;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        $totalSuppliers = Supply::count();
        $products = Product::count();
        $welfares = Welfare::count();
        $regements = Regement::count();
        $ranks = Rank::count();
        $units = Unit::count();
        $users = User::where('id', '!=', auth()->id())
                ->where('role', '!=', 'user')
                ->with(['welfare'])
                ->get();
        
        // Stock counts for Welfare Shop Clerk and Welfare Shop OC
        $totalStock = 0;
        $availableStock = 0;
        $soldStock = 0;
        $damagedStock = 0;
        $productStocks = collect();
        $categories = collect();
        $categoryStocks = collect();
        
        if ($user->hasRole('Welfare Shop Clerk') || $user->hasRole('Welfare Shop OC')) {
            $totalStock = Stock::where('welfare_id', $user->welfare_id)->count();
            $availableStock = Stock::where('welfare_id', $user->welfare_id)->where('status', 'available')->count();
            $soldStock = Stock::where('welfare_id', $user->welfare_id)->where('status', 'sold')->count();
            $damagedStock = Stock::where('welfare_id', $user->welfare_id)->where('status', 'damaged')->count();
            
            // Get all categories that have approved products (active = 0)
            $categories = \App\Models\Category::whereHas('products', function($query) {
                    $query->where('active', 0); // Only approved products
                })
                ->withCount(['products' => function($query) {
                    $query->where('active', 0);
                }])
                ->orderBy('category')
                ->get();
            
            // Get products grouped by category (only approved products)
            $categoryStocks = \App\Models\Product::with('category')
                ->where('active', 0) // Only approved products
                ->whereHas('category')
                ->get()
                ->groupBy(function($product) {
                    return $product->category->category;
                })
                ->map(function($products) use ($user) {
                    return $products->map(function($product) use ($user) {
                        // Count available stock for this product in user's welfare
                        $stockCount = Stock::where('welfare_id', $user->welfare_id)
                            ->where('product_id', $product->id)
                            ->where('status', 'available')
                            ->count();
                        
                        return (object)[
                            'item_name' => $product->product,
                            'item_category' => $product->category->category,
                            'item_model' => $product->product_number,
                            'available_count' => $stockCount,
                            'normal_price' => $product->normal_price,
                            'welfare_price' => $product->welfare_price,
                        ];
                    });
                });
        }
        
        return view('home', compact('totalSuppliers', 'products', 'welfares', 'regements', 'ranks', 'units', 'users', 'totalStock', 'availableStock', 'soldStock', 'damagedStock', 'categories', 'categoryStocks'));
    }
}
