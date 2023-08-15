<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="Client",
 *     type="object",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="email", type="string"),
 *     @OA\Property(property="image_link", type="string"),
 *     @OA\Property(property="type_client_id", type="integer"),
 *     @OA\Property(
 *         property="contacts",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Contact")
 *     ),
 *     @OA\Property(
 *         property="sellers",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Seller")
 *     ),
 * )
 */
class ClientResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'image_link' => $this->image_path ? asset('storage/' . $this->image_path) : null,
            'type_client_id' => $this->type_client_id,
            'contacts' => ContactResource::collection($this->contacts),
            'sellers' => SellerResource::collection($this->sellers),
        ];
    }
}
