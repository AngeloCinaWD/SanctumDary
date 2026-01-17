<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TasksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string)$this->id,
            'attributes' => [
                'name' => $this->name,
                'description' => $this->description,
                'priority' => $this->priority,
                'created_at' => Carbon::parse($this->created_at)->format('d/m/Y')
            ],
            'user' => [
                'id' => (string)$this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
            ]
        ];
    }
}
