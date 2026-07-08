<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FoodifyController extends Controller
{
    public function index()
    {
        return view('modules.Foodify.beranda');
    }

    public function kategori()
    {
        return view('modules.Foodify.kategori');
    }

    public function produk()
    {
        $produk = DB::table('produk')->orderBy('id_produk', 'desc')->get();
        return view('modules.Foodify.produk', compact('produk'));
    }

    public function profil()
    {
        return view('modules.Foodify.profil');
    }

    public function pendaftaran(Request $request)
    {
        $edit_mode = false;
        $data_edit = null;

        if ($request->has('edit')) {
            $edit_mode = true;
            $data_edit = DB::table('member')->where('id_member', $request->edit)->first();
        }

        $members = DB::table('member')->orderBy('id_member', 'desc')->get();

        return view('modules.Foodify.pendaftaran', compact('members', 'edit_mode', 'data_edit'));
    }

    public function storeMember(Request $request)
    {
        $tanggal_lahir = $request->thn . '-' . str_pad($request->bln, 2, '0', STR_PAD_LEFT) . '-' . str_pad($request->tgl, 2, '0', STR_PAD_LEFT);

        DB::table('member')->insert([
            'nama' => $request->nama,
            'email' => $request->email,
            'nohp' => $request->nohp,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jk,
            'tanggal_lahir' => $tanggal_lahir
        ]);

        return redirect()->route('foodify.pendaftaran')->with('success', 'Member berhasil ditambahkan');
    }

    public function updateMember(Request $request)
    {
        $tanggal_lahir = $request->thn . '-' . str_pad($request->bln, 2, '0', STR_PAD_LEFT) . '-' . str_pad($request->tgl, 2, '0', STR_PAD_LEFT);

        DB::table('member')->where('id_member', $request->id_member)->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'nohp' => $request->nohp,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jk,
            'tanggal_lahir' => $tanggal_lahir
        ]);

        return redirect()->route('foodify.pendaftaran')->with('success', 'Member berhasil diubah');
    }

    public function deleteMember(Request $request)
    {
        DB::table('member')->where('id_member', $request->hapus)->delete();
        return redirect()->route('foodify.pendaftaran')->with('success', 'Member berhasil dihapus');
    }
}
