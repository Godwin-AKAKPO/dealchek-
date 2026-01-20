<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SellerController extends Controller
{
    public function register(Request $request)
    {
        if ($request->user()->is_seller) {
            return redirect()->route('seller.products');
        }

        return Inertia::render('Seller/Register');
    }

    public function store(Request $request)
    {
        if ($request->user()->is_seller) {
            return redirect()->route('seller.products');
        }

        $request->user()->update([
            'is_seller' => true,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Félicitations ! Vous êtes maintenant vendeur sur DealChéké.');
    }

    public function products(Request $request)
    {
        $products = $request->user()
            ->products()
            ->withCount('transactions')
            ->latest()
            ->paginate(12);

        return Inertia::render('Seller/Products', [
            'products' => $products,
        ]);
    }

    public function sales(Request $request)
    {
        $sales = $request->user()
            ->sales()
            ->with(['product', 'buyer'])
            ->latest()
            ->paginate(15);

        return Inertia::render('Seller/Sales', [
            'sales' => $sales,
        ]);
    }
}