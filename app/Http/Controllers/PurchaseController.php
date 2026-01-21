<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        $purchases = $request->user()
            ->purchases()
            ->with(['product', 'seller'])
            ->latest()
            ->paginate(15);

        return Inertia::render('Purchases/Index', [
            'purchases' => $purchases,
        ]);
    }
}