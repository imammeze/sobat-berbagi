<?php

namespace App\Repositories;

use App\Interfaces\MitraRepositoryInterface;
use App\Models\Mitra;
use App\Models\User;

class MitraRepository implements MitraRepositoryInterface
{
    public function getAllMitra()
    {
        return User::with('mitraRelation')->whereHas('roles', function ($query) {
            $query->where('name', 'mitra');
        })->get();
    }

    public function getMitraById($id)
    {
        return Mitra::find($id);
    }

    public function getMitraBySlug($slug)
    {
        return Mitra::where('slug', $slug)->first();
    }

    public function deleteMitraById($id)
    {
        return Mitra::destroy($id);
    }

    public function rejectMitraById($id)
    {
        $mitra = Mitra::find($id);
        $mitra->status = 'rejected';
        $mitra->save();
        return $mitra;
    }

    public function approveMitraById($id)
    {
        $mitra = Mitra::where('id', $id)->first();

        $mitra->status = 'verified';
        $mitra->save();

        return $mitra;
    }

    public function getVerifiedMitra()
    {
        return User::with('mitraRelation')->whereHas('roles', function ($query) {
            $query->where('name', 'mitra');
        })->whereHas('mitraRelation', function ($query) {
            $query->where('status', 'verified');
        })->get();
    }
}
