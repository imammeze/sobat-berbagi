<?php

namespace App\Interfaces;

interface MitraRepositoryInterface
{
    public function getAllMitra();
    public function getMitraById($id);
    public function getMitraBySlug($slug);
    public function deleteMitraById($id);
    public function rejectMitraById($id);
    public function approveMitraById($id);
    public function getVerifiedMitra();
}
