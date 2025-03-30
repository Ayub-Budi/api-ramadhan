<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penerima;
use Illuminate\Support\Str;


/**
 * @OA\Tag(
 *     name="Penerima",
 *     description="API untuk mengelola penerima"
 * )
 */
class PenerimaController extends Controller {
    
    /**
     * @OA\Get(
     *     path="/api/penerima",
     *     tags={"Penerima"},
     *     summary="Menampilkan semua penerima",
     *     security={{"bearerAuth": {}}},
     *     description="Mengembalikan daftar semua penerima",
     *     @OA\Response(
     *         response=200,
     *         description="Daftar penerima berhasil diambil",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Penerima"))
     *     )
     * )
     */
    public function index() {
        return response()->json(Penerima::all());
    }

    /**
     * @OA\Post(
     *     path="/api/penerima",
     *     tags={"Penerima"},
     *     summary="Menambahkan penerima baru",
     *     security={{"bearerAuth": {}}},
     *     description="Membuat penerima baru dan mengembalikan data yang telah dibuat",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nama"},
     *             @OA\Property(property="nama", type="string", example="John Doe")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Penerima berhasil dibuat",
     *         @OA\JsonContent(ref="#/components/schemas/Penerima")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validasi gagal",
     *         @OA\JsonContent(type="object", @OA\Property(property="error", type="string", example="Validasi gagal"))
     *     )
     * )
     */
    public function store(Request $request) {
        $request->validate(['nama' => 'required|string|max:255']);

        $penerima = Penerima::create([
            'id' => Str::uuid(),
            'nama' => $request->nama
        ]);

        return response()->json($penerima, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/penerima/{id}",
     *     tags={"Penerima"},
     *     summary="Menampilkan detail penerima",
     *     description="Mengembalikan detail penerima berdasarkan ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID penerima",
     *         required=true,
     *         @OA\Schema(type="string", format="uuid")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detail penerima berhasil diambil",
     *         @OA\JsonContent(ref="#/components/schemas/Penerima")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Penerima tidak ditemukan",
     *         @OA\JsonContent(type="object", @OA\Property(property="error", type="string", example="Penerima tidak ditemukan"))
     *     )
     * )
     */
    public function show($id) {
        $penerima = Penerima::findOrFail($id);
        return response()->json($penerima);
    }
}
