<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;
use Illuminate\Support\Facades\Auth;

class AbsentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('absents.absent');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = date("Y-m-d");
        $validate = $request->validate([
            'keterangan' => 'required',
            'foto' => 'image|file|max:2048'
        ]);

        $doubleSS = Presensi::where([
            'nis' => Auth::user()->user_id,
            'tanggal' => $date
        ])->count();

        if($doubleSS > 0) {
            return redirect('/asStudent')->with('sudah absen', 'Kamu sudah mengisi presensi, silahkan isi lagi besok!');
        };

        $validate['foto'] = $request->file('foto')->store('keterangan-tidak-hadir');

        Presensi::create([
            'nis' => Auth::user()->user_id,
            'foto' => $validate['foto'],
            'tanggal' => $date,
            'keterangan' => $validate['keterangan']
        ]);

        return back()->with('absent terkirim', 'Terkirim!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Absent $absent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Absent $absent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absent $absent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absent $absent)
    {
        //
    }
}
