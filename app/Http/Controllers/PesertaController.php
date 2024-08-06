<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelatihan;
use App\Models\Peserta;
use Illuminate\Support\Str;

class PesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    

    public function index()
    {
        $row = Pelatihan::where('slug',$slug)->get();
        if ($row->isEmpty()) {
            return redirect()->route('course')->with('rusak', 'Pelatihan tidak ditemukan');
        }
            return view('course', compact('row'), [
                'title' => $slug
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($slug, Request $request)
    {
        if (isset($request['no_hp']) OR !empty($request['no_hp'])){
            if(strlen($request['no_hp']) < 10 || strlen($request['no_hp']) > 13){
                return redirect()->back()->with('galat','gagal menambahkan data pelatihan')->withErrors(['error' => 'Terjadi kesalahan saat menambahkan data'])->withInput();
            }
        }
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'institut' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:15',
            'pelatihan_id' => 'nullable|integer',
        ]);
        try {
            Peserta::create($validatedData);
            return redirect('/')->with('success',''.$request['name'].' telah ditambahkan ke pelatihan');
        }catch (\Exception $e){
            return redirect()->back()->with('galat','gagal menambahkan data pelatihan')->withErrors(['error' => 'Terjadi kesalahan saat menambahkan data'])->withInput();
        }         
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
    public function edit($id)
    {
        $row = Peserta::where('id', $id)->get();
        return view('peserta', compact('row'), [
            'title' => ""
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id ,Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'institut' => 'required',
            'jabatan' => 'required',
            'no_hp' => '',
        ]);

        try {
            $p = Pelatihan::where('id',$request->pelatihan_id)->get();
            
            Peserta::where('id', $id)->update($validatedData);
            return redirect(route('admin.course.detail', ['slug' => $p[0]['slug']]))->with('warning','Peserta : '.$request['name'].' telah berhasil diubah');
        }catch (\Exception $e){
            return redirect()->back()->with('galat','gagal mengubah data pelatihan')->withErrors(['error' => 'Terjadi kesalahan saat menambahkan data'])->withInput();
        }  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {
        $p = Pelatihan::where('id',$request->pelatihan_id)->get();
        Peserta::where('id', $id)->delete();
        return redirect(route('admin.course.detail', ['slug' => $p[0]['slug']]))->with('danger','Peserta telah berhasil dihapus');
    }
}
