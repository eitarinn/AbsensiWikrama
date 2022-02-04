<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\Student;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $presensis = Presensi::latest()->paginate(5);
            return view('presensis.index', compact('presensis'))
               ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Student::all();
        return view('presensis.create', compact('students'));
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
            'nis' => 'required',
            'keterangan' => 'required', 
            'foto' => 'image|file|max:2048'
        ]);

        $doubleSS = Presensi::where([
            'nis' => validate['nis'],
            'tanggal' => $date
        ])->count();

        if($doubleSS > 0){
            return redirect()->route('presensis.index')
                            ->with('sudah absen', 'silahkan isi lagi besok');
        };

        $validate['foto'] = $request->file('foto')->store('keterangan-tidak-hadir');

        Presensi::create([
            'nis' => $validate['nis'],
            'foto' => $validate['foto'],
            'tanggal' => $date,
            'keterangan' => $validate['keterangan']
        ]);

        return redirect()->route('presensis.index')
                         ->with('absentSuccess', 'Terkirim');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Presensi $presensi)
    {
        return view('presensis.show', compact('presensi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Presensi $presensi)
    {
        $students = Student::all();
        if($presensi['keterangan'] == "Hadir"){
            return view('presensis.edit', compact('presensi', 'students'));
        }elseif($presensi['keterangan == "Hadir namun belum mengisi absen pulang"']){
            return view('presensis.edit', compact('presensi', 'students'));
        }else{
            return redirect()->route('presensis.index')
                             ->with('tidak bisa edit', 'hanya yang hadir yang datanya bisa di edit');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Presensi $presensi)
    {
        $date = date("Y-m-d");
        $validate = $request->validate([
            'nis' => 'required',
            'keterangan' => 'required',
            'foto' => 'image|file|max:2048'
        ]);

        $validate['foto'] = $request->file('foto')->store('keterangan-tidak-hadir');
        $presensi->update([
            'nis' => $validate['nis'],
            'jam_kedatangan' => '',
            'jam_kepulangan' => '',
            'tanggal' => $date,
            'keterangan' => $validate['keterangan'],
            'foto' => $validate['foto']
        ]);

        return redirect()->route('presensis.index')
                         ->with('berhasil edit', 'Berhasil edit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Presensi $presensi)
    {
        $presensi->delete();
        return redirect()->route('presensis.index')
                         ->with('berhasil hapus', 'Berhasil Hapus!');
    }
}
