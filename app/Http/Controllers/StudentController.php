<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Rayon;
use App\Models\Rombel;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::latest()->paginate(5);
        return view('students.index', compact('students'))
               ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rayons = Rayon::all();
        $rombels = Rombel::all();
        $students = Student::all();
        return view('students.create', compact('rayons', 'rombels', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nis' => 'required', 
            'nama' => 'required', 
            'rombel' => 'required', 
            'rayon' => 'required', 
            'is_admin' => 'required'
        ]);

        $password = Hash::make($validate['nis']);

        Student::create($validate);
        User::create([
            'nama' => $validate['nama'],
            'username' => $validate['nis'],
            'password' => $password,
            'is_admin' => $validate['is_admin'],
            'user_id' => $validate['nis']
        ]);

        return redirect()->route('students.index')
                         ->with('success', 'Berhasil tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $students = Student::all();
        $rombels = Rombel::all();
        $rayons = Rayon::all();
        return view('students.edit', compact('student', 'rayons', 'rombels', 'students'), ['1' => 1]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'nis' => 'required', 
            'nama' => 'required', 
            'rombel' => 'required',
            'rayon' => 'required'
        ]);

        $student->update($request->all());
        return redirect()->route('students.index')
                         ->with('success', 'Berhasil edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')
                        ->with('success', 'Berhasil Hapus');
    }
}
