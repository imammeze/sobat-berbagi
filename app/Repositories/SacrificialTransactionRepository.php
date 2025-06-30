<?php

namespace App\Repositories;

use App\Interfaces\SacrificialTransactionRepositoryInterface;
use App\Models\SacrificialTransaction;
use App\Models\SacrificialTransactionDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SacrificialTransactionRepository implements SacrificialTransactionRepositoryInterface
{
    public function getAllSacrificialTransactions($paginate = null)
    {
        if ($paginate) {
            return SacrificialTransaction::with(['user', 'paymentMethod'])->orderBy('created_at', 'desc')->paginate($paginate);
        }
        return SacrificialTransaction::with(['user', 'paymentMethod'])->orderBy('created_at', 'desc')->get();
    }

    public function getSacrificialTransactionById(string $id)
    {
        return SacrificialTransaction::with(['user', 'paymentMethod'])->findOrFail($id);
    }

    public function createSacrificialTransaction(array $data)
    {
        DB::beginTransaction();

        $sacrificialTransaction = SacrificialTransaction::create([
            'sacrificial_name' => $data['sacrificial_name'],
            'sacrificial_type' => $data['sacrificial_type'],
            'user_id' => Auth::user()->id,
            'payment_method_id' => $data['payment_method_id'],
            'amount' => $data['amount'],
            'status' => 'pending',
        ]);

        foreach ($data['sacrificial_details'] as $detail) {
            SacrificialTransactionDetail::create([
                'sacrificial_transaction_id' => $sacrificialTransaction->id,
                'name' => $detail['name'],
            ]);
        }

        DB::commit();

        return $sacrificialTransaction;
    }

    public function updateSacrificialTransaction(array $data, string $id)
    {
        DB::beginTransaction();

        $sacrificialTransaction = $this->getSacrificialTransactionById($id);
        $sacrificialTransaction->update([
            'sacrificial_name' => $data['sacrificial_name'],
            'sacrificial_type' => $data['sacrificial_type'],
            'user_id' => Auth::user()->id,
            'payment_method_id' => $data['payment_method_id'],
            'amount' => $data['amount'],
            'status' => 'pending',
        ]);

        $sacrificialTransaction->sacrificialTransactionDetails()->delete();

        foreach ($data['sacrificial_details'] as $detail) {
            SacrificialTransactionDetail::create([
                'sacrificial_transaction_id' => $sacrificialTransaction->id,
                'name' => $detail['name'],
            ]);
        }

        DB::commit();

        return $sacrificialTransaction;
    }

    public function deleteSacrificialTransaction(string $id)
    {
        $sacrificialTransaction = $this->getSacrificialTransactionById($id);
        $sacrificialTransaction->delete();
        return $sacrificialTransaction;
    }

    public function getSacrificialTransactionByUserId(string $id)
    {
        return SacrificialTransaction::with(['user', 'paymentMethod'])->where('user_id', $id)->orderBy('created_at', 'desc')->get();
    }
}
