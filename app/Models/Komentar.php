<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

/**
 * @OA\Schema(
 *     schema="Komentar",
 *     title="Komentar",
 *     description="Model Komentar",
 *     @OA\Property(property="id", type="string", format="uuid", example="550e8400-e29b-41d4-a716-446655440000"),
 *     @OA\Property(property="komentar", type="string", example="Selamat Lebaran!"),
 *     @OA\Property(property="penerima_id", type="string", format="uuid", example="550e8400-e29b-41d4-a716-446655440000"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */

class Komentar extends Model {
    use HasFactory, HasUuids;

    protected $fillable = ['komentar', 'penerima_id'];

    public function penerima() {
        return $this->belongsTo(Penerima::class);
    }
}

