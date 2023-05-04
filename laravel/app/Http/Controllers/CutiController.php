<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['cutis'] = Cuti::paginate(1000);

        return view('cuti.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pegawais'] = Pegawai::all();

        return view('cuti.create', $data);
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
            'pegawai_id'      => 'required|exists:pegawai,id',
            'nomor_permohonan'      => 'required',
            'tanggal_mulai' => 'required|max:11',
            'tanggal_selesai' => 'required|max:11',
            'keterangan' => 'required'
        ]);

        Cuti::create($request->all());

        return redirect()->route('cuti.index')->with('success', 'Berhasil menambah cuti');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function show(Cuti $cuti)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function edit(Cuti $cuti)
    {
        $data['pegawais'] = Pegawai::all();
        $data['cuti'] = $cuti;

        return view('cuti.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cuti $cuti)
    {
        $this->validate($request, [
            'pegawai_id'      => 'required|exists:pegawai,id',
            'nomor_permohonan'      => 'required',
            'tanggal_mulai' => 'required|max:11',
            'tanggal_selesai' => 'required|max:11',
            'keterangan' => 'required'
        ]);

        $cuti->update($request->all());

        return redirect()->route('cuti.index')->with('success', 'Berhasil mengedit cuti');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuti $cuti)
    {
        $cuti->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus cuti');
    }

    public function hapus_semua(Request $request)
    {
        $cutis = Cuti::whereIn('id', json_decode($request->ids, true))->get();

        Cuti::whereIn('id', $cutis->pluck('id'))->delete();

        return back()->with('success', 'Berhasil menghapus banyak data cuti');
    }
    
    public function laporan()
    {
        $data['limit'] = Cuti::count();
        
        return view('cuti.laporan.index', $data);
    }

    public function print(Request $request)
    {
        $this->validate($request, [
            'field' => 'required|in:id,nomor_permohonan,tanggal_mulai,tanggal_selesai,keterangan',
            'order' => 'required|in:ASC,DESC',
            'limit' => 'required|integer|max:' . Cuti::count(),
        ]);

        $data['cutis'] = Cuti::orderBy($request->field, $request->order)->limit($request->limit)->get();

        if(!$data['cutis']->count()) {
            
            return back()->with('error', 'Data tidak ada!');
        }

        return view('cuti.laporan.print', $data);
    }
}
