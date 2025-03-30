<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Komentar;
use Illuminate\Support\Str;

/**
 * @OA\Tag(
 *     name="Komentar",
 *     description="API untuk mengelola komentar"
 * )
 */
class KomentarController extends Controller {
    
    /**
     * @OA\Get(
     *     path="/api/komentar",
     *     tags={"Komentar"},
     *     summary="Menampilkan semua komentar",
     *     description="Mengembalikan daftar semua komentar dengan penerima terkait",
     *     @OA\Response(
     *         response=200,
     *         description="Daftar komentar berhasil diambil",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Komentar"))
     *     )
     * )
     */
    public function index() {
        return response()->json(Komentar::with('penerima')->get());
    }

    /**
     * @OA\Post(
     *     path="/api/komentar",
     *     tags={"Komentar"},
     *     summary="Menambahkan komentar baru",
     *     description="Membuat komentar baru dan mengembalikan data yang telah dibuat",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"komentar", "penerima_id"},
     *             @OA\Property(property="komentar", type="string", example="Selamat Lebaran!"),
     *             @OA\Property(property="penerima_id", type="string", format="uuid", example="550e8400-e29b-41d4-a716-446655440000")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Komentar berhasil dibuat",
     *         @OA\JsonContent(ref="#/components/schemas/Komentar")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validasi gagal",
     *         @OA\JsonContent(type="object", @OA\Property(property="error", type="string", example="Validasi gagal"))
     *     )
     * )
     */
    public function store(Request $request) {
        $request->validate([
            'komentar' => 'required|string',
            'penerima_id' => 'required|exists:penerimas,id'
        ]);

        $komentar = Komentar::create([
            'id' => Str::uuid(),
            'komentar' => $request->komentar,
            'penerima_id' => $request->penerima_id
        ]);

        return response()->json($komentar, 201);
    }
}
