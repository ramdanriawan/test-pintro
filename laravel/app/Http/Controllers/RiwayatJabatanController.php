<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Models\RiwayatJabatan;
use App\Http\Controllers\Controller;

class RiwayatJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['riwayat_jabatans'] = RiwayatJabatan::paginate(1000);

        return view('riwayat_jabatan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['jabatans'] = Jabatan::all();
        $data['pegawais'] = Pegawai::all();

        return view('riwayat_jabatan.create', $data);
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
            'jabatan_id'      => 'required|exists:jabatan,id',
            'tanggal' => 'required|max:11|before:' . date('d-M-Y'),
            'status' => 'required|in:Aktif,Tidak Aktif',
            'nomor_sk' => 'required',
        ]);
        
        $requestData = $request->except(['jabatan_id']);

        $jabatan = Jabatan::findOrFail($request->jabatan_id);

        $requestData['nama_jabatan'] = $jabatan->nama;
        $requestData['gaji_jabatan'] = $jabatan->gaji;
        $requestData['tunjangan_jabatan'] = $jabatan->tunjangan;
        $requestData['bonus_jabatan'] = $jabatan->bonus;

        // kalo status aktif maka yang lain harus kita nonaktifkan
        if($request->status == "Aktif") {

            RiwayatJabatan::where('pegawai_id', $request->pegawai_id)->update(['status' => 'Tidak Aktif']);
        }

        RiwayatJabatan::create($requestData);

        return redirect()->route('riwayat_jabatan.index')->with('success', 'Berhasil menambah riwayat jabatan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RiwayatJabatan  $riwayatJabatan
     * @return \Illuminate\Http\Response
     */
    public function show(RiwayatJabatan $riwayatJabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiwayatJabatan  $riwayatJabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(RiwayatJabatan $riwayatJabatan)
    {
        $data['riwayat_jabatan'] = $riwayatJabatan;
        $data['jabatans'] = Jabatan::all();
        $data['pegawais'] = Pegawai::all();

        return view('riwayat_jabatan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiwayatJabatan  $riwayatJabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiwayatJabatan $riwayatJabatan)
    {
        $this->validate($request, [
            'pegawai_id'      => 'required|exists:pegawai,id',
            'jabatan_id'      => 'required|exists:jabatan,id',
            'tanggal' => 'required|max:11',
            'status' => 'required|in:Aktif,Tidak Aktif',
            'nomor_sk' => 'required',
        ]);
        
        $requestData = $request->except(['jabatan_id']);

        $jabatan = Jabatan::findOrFail($request->jabatan_id);

        $requestData['nama_jabatan'] = $jabatan->nama;
        $requestData['gaji_jabatan'] = $jabatan->gaji;
        $requestData['tunjangan_jabatan'] = $jabatan->tunjangan;

        if($request->status == "Aktif") {

            RiwayatJabatan::where('pegawai_id', $request->pegawai_id)->update(['status' => 'Tidak Aktif']);
        }

        $riwayatJabatan->update($requestData);

        return redirect()->route('riwayat_jabatan.index')->with('success', 'Berhasil mengupdate riwayat jabatan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiwayatJabatan  $riwayatJabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiwayatJabatan $riwayatJabatan)
    {
        $riwayatJabatan->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus riwayat jabatan');
    }

    public function hapus_semua(Request $request)
    {
        $riwayat_jabatans = RiwayatJabatan::whereIn('id', json_decode($request->ids, true))->get();

        RiwayatJabatan::whereIn('id', $riwayat_jabatans->pluck('id'))->delete();

        return back()->with('success', 'Berhasil menghapus banyak data riwayat jabatan');
    }
    
    public function laporan()
    {
        $data['limit'] = RiwayatJabatan::count();
        $data['nama_jabatans'] = RiwayatJabatan::pluck('nama_jabatan')->unique()->toArray();
        
        return view('riwayat_jabatan.laporan.index', $data);
    }

    public function print(Request $request)
    {
        
        $this->validate($request, [
            'field' => 'required|in:id,tanggal,jam_masuk,jam_keluar',
            'order' => 'required|in:ASC,DESC',
            'limit' => 'required|integer|max:' . RiwayatJabatan::count(),
        ]);

        $data['riwayat_jabatans'] = RiwayatJabatan::where('nama_jabatan', 'like', "%$request->nama_jabatan%")
        ->where('status', 'like', "%$request->status%")
        ->orderBy($request->field, $request->order)
        ->limit($request->limit)->get();

        if(!$data['riwayat_jabatans']->count()) {
            
            return back()->with('error', 'Data tidak ada!');
        }

        return view('riwayat_jabatan.laporan.print', $data);
    }
}
