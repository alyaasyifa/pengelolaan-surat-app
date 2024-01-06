<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Result;
use App\Models\User;
use App\Models\Letter;
use Illuminate\Http\Request;


class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $results = Result::with('letter')->get();
        $letter = Letter::with('letterType')->get();
        // dd($letter);
        return view('data.suratmasuk.index', compact('results', 'letter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $user = User::Where('role', 'guru')->get();

        $letter = Letter::Where('id', $id)->first();

        

        return view('data.suratmasuk.create', compact('user', 'letter'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $arrayDistinct = array_count_values($request->presence_recipients);
    $arrayAssoc = [];

    foreach ($arrayDistinct as $id => $count) {
        $user = User::find($id);

        // Periksa apakah pengguna ditemukan sebelum mengakses properti 'name'
        if ($user) {
            $arrayItem = [
                "id" => $id,
                "name" => $user->name,
            ];

            array_push($arrayAssoc, $arrayItem);
        }
    }

    // Convert the array to a JSON string
    $request['presence_recipients'] = json_encode($arrayAssoc);

    // You can use the DB facade to insert the data with the correct data type
    DB::table('results')->insert([
        'letter_id' => $request->letter_id,
        'presence_recipients' => $request['presence_recipients'],
        'notes' => $request->notes,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('data.suratmasuk.index')->with('success', 'Berhasil Menambah Data');
}

    /**
     * Display the specified resource.
     */
    public function show(Result $results, $id)
    {
        
        $result = Result::where('letter_id', $id)->first();

        $user = User::Where('role', 'guru')->get();

        $letter = Letter::find($id);

        return view('data.suratmasuk.detail', compact('result', 'user', 'letter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Result $result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Result $result)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Result $result)
    {
        //
    }
}
