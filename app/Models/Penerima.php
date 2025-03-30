<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
/**
 * @OA\Schema(
 *     schema="Penerima",
 *     title="Penerima",
 *     description="Model Penerima",
 *     @OA\Property(property="id", type="string", format="uuid", example="550e8400-e29b-41d4-a716-446655440000"),
 *     @OA\Property(property="nama", type="string", example="Ahmad Fauzi"),
 *     @OA\Property(property="alamat", type="string", example="Jl. Merdeka No. 45, Jakarta"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class Penerima extends Model {
    use HasFactory, HasUuids;

    protected $fillable = ['nama'];
}
