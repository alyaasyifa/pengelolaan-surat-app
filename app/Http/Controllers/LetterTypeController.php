<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Models\LetterType;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LetterTypeExport;

class LetterTypeController extends Controller
{
    public function export() {
        return Excel::download(new LetterTypeExport, 'Klasifikasi Surat.xlsx');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $letterTypes = LetterType::all();
        return view('data.klasifikasi.index', compact('letterTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $letterTypes = LetterType::all();

        return view('data.klasifikasi.create', compact('letterTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'letter_code' => 'required|numeric',
            'nama_type' => 'required|min:3',
        ]);

 
        $letterType = LetterType::count();
        
        LetterType::create([
            'letter_code' => $request->letter_code . '-' . $letterType,
            'nama_type' => $request->nama_type,
        ]);
        
        return redirect()->back()->with('success', 'Berhasil menambahkan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $guru = User::all()->where('role', 'guru');
        $letterType = LetterType::find($id);
        return view('data.klasifikasi.detail', compact('letterType', 'guru'));
    }

    // public function downloadPDF($id){
    //     $letterType = LetterType::find($id)->toArray();
    //     view()->share('letterTypes', $letterType);
    //     $pdf = PDF::loadView('data.klasifikasi.downloadpdf', $letterType);
    //     return $pdf->download('letter.pdf');
    // }

    //punya rehan
    public function downloadPDF($id) 
    { 
        // Ambil objek model Letters berdasarkan ID
        $letterTypes = LetterType::find($id); 
    
        // Periksa apakah surat ditemukan
        if (!$letterTypes) {
            // Lakukan penanganan jika surat tidak ditemukan
            // Misalnya, redirect ke halaman tertentu atau tampilkan pesan kesalahan
            // Di sini, saya mengembalikan response dengan pesan kesalahan
            return response()->json(['error' => 'Surat tidak ditemukan'], 404);
        }
    
        // Kirim objek model surat ke view
        view()->share('letterTypes', $letterTypes); 
    
        // Panggil view blade yang akan dicetak PDF serta data yang akan digunakan
        $pdf = PDF::loadView('data.klasifikasi.downloadpdf', compact('letterTypes')); 
    
        // Download PDF file dengan nama tertentu
        return $pdf->download('letter.pdf'); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $letterTypes = LetterType::find($id);
        return view('data.klasifikasi.edit', compact('letterTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'letter_perihal' => 'required|min:3',
            'nama_type' => 'required|min:3',
        ]);

        LetterType::where('id', $id)->update([
            'letter_code' => $request->letter_code,
            'nama_type' => $request->nama_type,
        ]);

        return redirect()->route('data.klasifikasi.home')->with('success', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        LetterType::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }

    // public function data() 
    // {
    //     $letterTypes = Order::with('letterType')->simplePaginate(10);
    //     return view("data.klarifikasi.index", compact('letterTypes'));
    // }
}
