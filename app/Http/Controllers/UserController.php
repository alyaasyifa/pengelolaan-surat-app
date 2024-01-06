<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Letter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::all(); //compact memanggil variabel dari $users
        return view('user.index', compact('users')); //nampilin juga
        //gabungin data biaar bisa munculin data 
    }

    public function guru() {
        $guru = User::where('role', 'guru')->get();

        return view('user.guru.index', compact('guru'));
    }

    public function staff() {
        $staff = User::where('role', 'staff')->get();

        return view('user.staff.index', compact('staff'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $user = User::all();

        return view('user.create', compact('user'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|min:3',
            'role' => 'required',
        ]);

        $emailPrefix = substr($request->email, 0, 3);
        $namePrefix = substr($request->name, 0, 3);
        $generatedPassword = $emailPrefix . $namePrefix;

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($generatedPassword),
            'role' => $request->role,
        ]);
        //jadi redirect back tuh jadi kehalaman sebelumnya, dengan alert with apa itu sesuai di dalemmya
        return redirect()->back()->with('success', 'Berhasil menambahkan data pengguna!');
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
    /**
 * Show the form for editing the specified resource.
 */
    public function edit(string $id)
    {
        //
        $user = User::find($id);
        return view('user.staff.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|min:3',
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $userData['password'] = bcrypt($request->password);
        }

        User::where('id', $id)->update($userData);

        // Check the role and redirect accordingly
        $user = User::find($id);

        if ($user->role == 'guru') {
            return redirect()->route('user.guru.home')->with('success', 'Berhasil mengubah data!');
        } elseif ($user->role == 'staff') {
            return redirect()->route('user.staff.home')->with('success', 'Berhasil mengubah data!');
        } else {
            // Handle other roles or provide a default redirect
            return redirect()->route('default.home')->with('success', 'Berhasil mengubah data!');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        User::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }

    //login page
    public function loginAuth(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        $user = $request->only(['email', 'password']);
        // dd($user);
        if(Auth::attempt($user)) {
            return redirect()->route('home');
        } else{
            return redirect()->back()->with('failed', 'Proses login gagal, Silahkan coba kembali dengan data yang benar!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('logout', 'Anda telah logout!');
    }
}
