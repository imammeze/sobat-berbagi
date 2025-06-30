<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\ZakatTransactionResource;
use App\Models\ZakatTransaction;

class ZakatTransactionController extends Controller
{
    public function getZakatMaalTransaction()
    {
        $transactions =  ZakatTransaction::where('status', 'success')->orderBy('created_at', 'desc')->paginate(10);

        return response()->json([
            'status' => 'success',
            'data' => ZakatTransactionResource::collection($transactions),
            'pagination' => [
                'current_page' => $transactions->currentPage(),
                'total_pages' => $transactions->lastPage(),
                'per_page' => $transactions->perPage(),
                'total' => $transactions->total(),
            ],
        ]);
    }
}
