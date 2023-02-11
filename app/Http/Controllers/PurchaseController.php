<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::all();
        return response()->view('ase.purchase.index', compact('purchases'));
    }

    public function destroy(Purchase $purchase)
    {
        $isDelete = $purchase->delete();
        return response()->json(
            ['message' => $isDelete ? ' Delete Purchase Successfully ! ' : ' Delete Purchase Faild ! '],
            $isDelete ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
