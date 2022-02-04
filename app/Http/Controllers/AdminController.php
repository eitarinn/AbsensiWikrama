<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = User::latest()->paginate(5);
        return view('admins.index', compact('admins'))
               ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.create');
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
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',
            'is_admin' => 'required'
        ]);

        $validate['password'] = Hash::make($validate['password']);

        User::create($validate);
        return redirect()->route('admins.index')
                         ->with('success', 'Berhasil tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $admin)
    {
        if($admin['is_admin'] == "admin"){
            return view('admins.edit', compact('admin'));
        }else{
            return redirect()->route('admins.index')
                             ->with('Tidak bisa edit', 'Hanya admin yang bisa mengedit data');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $admin)
    {
        $validate = $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'newpassword1' => 'required',
            'newpassword2' => 'required',
            'is_admin' => 'required'
        ]);

        if (Auth::user()->nama == $validate['nama']) {
            if ($validate['newpassword1'] == $validate['newpassword2']) {
                $validate['newpassword1'] = bcrypt($validate['newpassword1']);
                $admin->update([
                    'nama' => $validate['nama'],
                    'username' => $validate['username'],
                    'password' => $validate['newpassword1'],
                    'is_admin' => $validate['is_admin'],
                    'user_id' => NULL
                ]);
        
                return redirect()->route('admins.index')->with('berhasil edit','data changed successfully');
            }
            return back()->with('cant edit','Edit failed');
        }
        return redirect()->route('admins.index')->with('not user','You can only change your own data');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        $admin->delete();
        return redirect()->route('admins.index')
                         ->with('success', 'Berhasil hapus');
    }
}
