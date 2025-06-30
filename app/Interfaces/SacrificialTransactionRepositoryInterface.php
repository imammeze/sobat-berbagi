<?php

namespace App\Interfaces;

interface SacrificialTransactionRepositoryInterface
{
    public function getAllSacrificialTransactions($paginate = null);
    public function getSacrificialTransactionById(string $id);
    public function createSacrificialTransaction(array $data);
    public function updateSacrificialTransaction(array $data, string $id);
    public function deleteSacrificialTransaction(string $id);
    public function getSacrificialTransactionByUserId(string $id);
}
