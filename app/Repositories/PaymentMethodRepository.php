<?php

namespace App\Repositories;

use App\Interfaces\PaymentMethodRepositoryInterface;
use App\Models\PaymentMethod;

class PaymentMethodRepository implements PaymentMethodRepositoryInterface
{
    public function getAllPaymentMethods()
    {
        return PaymentMethod::all();
    }

    public function getPaymentMethodById($id)
    {
        return PaymentMethod::find($id);
    }

    public function createPaymentMethod($data)
    {
        return PaymentMethod::create($data);
    }

    public function updatePaymentMethod($data, $id)
    {
        return PaymentMethod::find($id)->update($data);
    }

    public function deletePaymentMethod($id)
    {
        return PaymentMethod::find($id)->delete();
    }

    public function getPaymentMethodByCategory(string $category)
    {
        return PaymentMethod::where('category', $category)->get();
    }
}
