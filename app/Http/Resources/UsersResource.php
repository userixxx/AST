<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class UsersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        try {
            $decrypted = Crypt::decryptString($this->password);
            $this->password = $decrypted;
        } catch (DecryptException $e) {
            $this->password = 123;
        }
        return [
            'id' => $this->id,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
