<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use File;

class StudentApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all()->toJson(JSON_PRETTY_PRINT);
        return response($students, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'nama' => 'required|min:3|max:50',
            'kerjaan' => 'required',
            'testimony' => '',
        ]);
        if ($validateData->fails()) {
            return response($validateData->errors(), 400);
        } else {
            $mahasiswa = new Student();
            $mahasiswa->name = $request->nama;
            $mahasiswa->pekerjaan = $request->kerjaan;
            $mahasiswa->testimoni = $request->testimony;
            $mahasiswa->save();
            return response()->json([
                "message" => "Data berhasil ditambahkan"
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Student::where('id', $id)->exists()) {
            $validateData = Validator::make($request->all(), [
                'nama' => 'required|min:3|max:50',
                'kerjaan' => 'required',
                'testimony' => '',
            ]);
            if ($validateData->fails()) {
                return response($validateData->errors(), 400);
            } else {
                $mahasiswa = Student::find($id);
                $mahasiswa->name = $request->nama;
                $mahasiswa->pekerjaan = $request->kerjaan;
                $mahasiswa->testimoni = $request->testimony;
                $mahasiswa->save();
                return response()->json([
                    "message" => "Data berhasil diubah"
                ], 201);
            }
        } else {
            return response()->json([
                "message" => "Data tidak di temukan"
            ], 404);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Student::where('id', $id)->exists()) {
            $mahasiswa = Student::find($id);
            $mahasiswa->delete();
            return response()->json([
                "message" => "Data berhasil dihapus"
            ], 201);
        } else {
            return response()->json([
                "message" => "Data tidak di temukan"
            ], 404);
        }

    }
}
