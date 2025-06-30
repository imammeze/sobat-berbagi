<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ZakatTransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->is_anonymous == 1 ? null : $this->user->donaturRelation->name,
            'avatar' => $this->user->donaturRelation->avatar,
            'amount' => $this->amount,
            'is_anonymous' => $this->is_anonymous,
            'created_at' => Carbon::parse($this->created_at)->isoFormat('D MMMM Y'),
        ];
    }
}
