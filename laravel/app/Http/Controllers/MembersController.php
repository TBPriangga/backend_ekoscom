<?php

namespace App\Http\Controllers;

use App\Models\Members;
use Illuminate\Http\Request;


class MembersController extends Controller
{
    public function create()
    {
        return view('member.create');
    }
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required|min:3|max:50',
            'pekerjaan' => 'required',
            'testimoni' => '',
        ]);
        $user = new Members();
        $user->name = $validateData['nama'];
        $user->departement = $validateData['pekerjaan'];
        $user->testimony = $validateData['testimoni'];
        $user->save();
        $request->session()->flash('pesan', 'Penambahan data berhasil');
        return redirect()->route('members.index');
    }

    public function index()
    {
        $users = Members::all();
        return view('member.index', ['members' => $users]);
    }

    public function show($member_id)
    {
        $result = Members::findOrFail($member_id);
        return view('member.show', ['member' => $result]);
    }

    public function edit($member_id)
    {
        $result = Members::findOrFail($member_id);
        return view('member.edit', ['member' => $result]);
    }

    public function update(Request $request, Members $user)
    {
        $validateData = $request->validate([
            'nama' => 'required|min:3|max:50',
            'pekerjaan' => 'required',
            'testimoni' => '',
        ]);
        $user->name = $validateData['nama'];
        $user->departement = $validateData['pekerjaan'];
        $user->testimony = $validateData['testimony'];
        $user->save();
        $request->session()->flash('pesan', 'Perubahan data berhasil');
        return redirect()->route('member.show', ['member' => $user->id]);
    }

    public function destroy(Request $request, Members $members)
    {
        $members->delete();
        $request->session()->flash('pesan', 'Hapus data berhasil');
        return redirect()->route('member.index');
    }
}
