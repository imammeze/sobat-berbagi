<?php

namespace App\Interfaces;

interface PaymentMethodRepositoryInterface
{
    public function getAllPaymentMethods();
    public function getPaymentMethodById($id);
    public function createPaymentMethod($data);
    public function updatePaymentMethod($data, $id);
    public function deletePaymentMethod($id);
    public function getPaymentMethodByCategory(string $category);
}
