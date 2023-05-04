<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['jabatans'] = Jabatan::all();

        return view('jabatan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('jabatan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'      => "required|unique:jabatan,nama",
            'gaji'      => 'required|integer|digits_between:5,7',
            'tunjangan' => 'required|integer|digits_between:5,7',
            'bonus' => 'required|integer|digits_between:5,7',
        ]);

        Jabatan::create($request->all());

        return redirect()->route('jabatan.index')->with('success', 'Berhasil menambah jabatan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Jabatan $jabatan)
    {
        //
        $data['jabatan'] = $jabatan;

        return view('jabatan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        $this->validate($request, [
            'nama'      => "required|unique:jabatan,nama,$request->nama,nama",
            'gaji'      => 'required|integer|digits_between:5,7',
            'tunjangan' => 'required|integer|digits_between:5,7',
            'bonus' => 'required|integer|digits_between:5,7',
        ]);

        $jabatan->update($request->all());

        return redirect()->route('jabatan.index')->with('success', 'Berhasil mengubah jabatan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jabatan $jabatan)
    {
        $jabatan->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus jabatan');
    }

    public function hapus_semua(Request $request)
    {
        $jabatans = Jabatan::whereIn('id', json_decode($request->ids, true))->get();

        Jabatan::whereIn('id', $jabatans->pluck('id'))->delete();

        return back()->with('success', 'Berhasil menghapus banyak data jabatan');
    }

    public function laporan()
    {
        $data['limit'] = Jabatan::count();
        
        return view('jabatan.laporan.index', $data);
    }

    public function print(Request $request)
    {
        $this->validate($request, [
            'field' => 'required|in:id,nama,gaji,tunjangan',
            'order' => 'required|in:ASC,DESC',
            'limit' => 'required|integer|max:' . Jabatan::count(),
        ]);

        $data['jabatans'] = Jabatan::orderBy($request->field, $request->order)->limit($request->limit)->get();

        if(!$data['jabatans']->count()) {
            
            return back()->with('error', 'Data tidak ada!');
        }

        return view('jabatan.laporan.print', $data);
    }
}
