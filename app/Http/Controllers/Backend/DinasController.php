<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\GeneralConfig;
use RealRashid\SweetAlert\Facades\Alert;

class DinasController extends BackendController
{
    public function index()
    {
        $data = [
            'name' => GeneralConfig::where('slug', 'kepala-dinas')->first()->value,
            'nip' => GeneralConfig::where('slug', 'nip-kepala-dinas')->first()->value,
        ];
        return view('backend.pages.dinas.index', compact('data'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|string',
            'nip' => 'required|numeric'
        ], [], [
            'name' => 'Nama Kepala Dinas',
            'nip' => 'NIP',
        ]);

        GeneralConfig::where('slug', 'kepala-dinas')
            ->update(['value' => $request->name]);
        GeneralConfig::where('slug', 'nip-kepala-dinas')
            ->update(['value' => $request->nip]);

        Alert::success('Sukses!', 'Berhasil mengubah data dinas.');
        return back();
    }
}
