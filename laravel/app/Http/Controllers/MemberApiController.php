<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Members;
use Illuminate\Support\Facades\Validator;
use File;

class MemberApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Members::all()->toJson(JSON_PRETTY_PRINT);
        return response($members, 200);

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
            'pekerjaan' => 'required',
            'testimoni' => '',
            'image' => 'required|file|image|max:1000',
        ]);
        if ($validateData->fails()) {
            return response($validateData->errors(), 400);
        } else {
            $user = new Members();
            $user->name = $request->nama;
            $user->departement = $request->pekerjaan;
            $user->testimony = $request->testimoni;
            if ($request->hasFile('image')) {
                $extFile = $request->image->getClientOriginalExtension();
                $namaFile = 'user-' . time() . "." . $extFile;
                $path = $request->image->move('assets/images', $namaFile);
                $user->image = $path;
            }
            $user->save();
            return response()->json([
                "message" => "student record created"
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
