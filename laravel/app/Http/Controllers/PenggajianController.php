<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Penggajian;
use Illuminate\Http\Request;
use App\Models\RiwayatJabatan;
use App\Http\Controllers\Controller;
use App\Models\Absensi;

class PenggajianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['penggajians'] = Penggajian::paginate(1000)->reverse();

        return view('penggajian.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        // memilih pegawai yang belum gajian
        // $pegawais = Pegawai::pluck('id')->toArray();
        // $pegawai_ids = Penggajian::whereIn('pegawai_id', $pegawais)->get();
        // $data['pegawais'] = Pegawai::whereNotIn(['pegawai_id', $pegawai_ids]);
        $riwayat_jabatan_pegawai_ids = RiwayatJabatan::where('status', 'Aktif')->pluck('pegawai_id')->unique()->toArray();
        $data['pegawais'] = Pegawai::whereIn('id', $riwayat_jabatan_pegawai_ids)->get()->map(function($item) {

            $item->total_gaji = $this->getGaji($item);

            return $item;
        });

        return view('penggajian.create', $data);
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
            'periode' => 'required',
            'tahun' => 'required',
            'tanggal' => 'required',
        ]);

        $requestData = $request->all();

        // pengecekan jabatan aktif atau tidak
        $riwayat_jabatan = RiwayatJabatan::where(['pegawai_id' => $request->pegawai_id, 'status' => 'Aktif'])->get()->first();
        
        if(!$riwayat_jabatan) {

            return back()->with('error', 'Tidak ada riwayat jabatan yang aktif');
        }

        // pengecekan sudah digaji atau belum
        $penggajian = Penggajian::where(['pegawai_id' => $request->pegawai_id, 'periode' => $request->periode, 'tahun' => $request->tahun])->get()->first();
        
        if($penggajian) {

            return back()->with('error', 'Karyawan sudah digaji!');
        }

        $requestData['gaji'] = $this->getGaji(Pegawai::findOrFail($request->pegawai_id));
        $requestData['tunjangan'] = $riwayat_jabatan->tunjangan_jabatan;
        $requestData['bonus'] = $riwayat_jabatan->bonus_jabatan;

        Penggajian::create($requestData);

        return redirect()->route('penggajian.index')->with('success', 'Berhasil menambah penggajian');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penggajian  $penggajian
     * @return \Illuminate\Http\Response
     */
    public function show(Penggajian $penggajian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penggajian  $penggajian
     * @return \Illuminate\Http\Response
     */
    public function edit(Penggajian $penggajian)
    {
        $riwayat_jabatan_pegawai_ids = RiwayatJabatan::where('status', 'Aktif')->pluck('pegawai_id')->unique()->toArray();
        $data['pegawais'] = Pegawai::whereIn('id', $riwayat_jabatan_pegawai_ids)->get();
        $data['penggajian'] = $penggajian;

        return view('penggajian.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penggajian  $penggajian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penggajian $penggajian)
    {
        $this->validate($request, [
            'pegawai_id'      => 'required|exists:pegawai,id',
            'periode' => 'required',
            'tahun' => 'required',
            'tanggal' => 'required',
        ]);

        $requestData = $request->all();

        // pengecekan jabatan aktif atau tidak
        $riwayat_jabatan = RiwayatJabatan::where(['pegawai_id' => $request->pegawai_id, 'status' => 'Aktif'])->get()->first();
        
        if(!$riwayat_jabatan) {

            return back()->with('error', 'Tidak ada riwayat jabatan yang aktif');
        }

        // pengecekan sudah digaji atau belum

        $requestData['gaji'] = $this->getGaji(Pegawai::findOrFail($request->pegawai_id));
        $requestData['tunjangan'] = $riwayat_jabatan->tunjangan_jabatan;
        $requestData['bonus'] = $riwayat_jabatan->bonus_jabatan;
        
        $penggajian->update($requestData);

        return redirect()->route('penggajian.index')->with('success', 'Berhasil mengupdate penggajian');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penggajian  $penggajian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penggajian $penggajian)
    {
        $penggajian->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus penggajian');
    }

    public function hapus_semua(Request $request)
    {
        $penggajians = Penggajian::whereIn('id', json_decode($request->ids, true))->get();

        Penggajian::whereIn('id', $penggajians->pluck('id'))->delete();

        return back()->with('success', 'Berhasil menghapus banyak data penggajian');
    }
    
    public function laporan()
    {
        $data['limit'] = Penggajian::count();
        $data['periodes'] = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $data['tahuns'] = range(date('Y') - 5, date('Y'));
        array_unshift($data['tahuns'], '');
        
        return view('penggajian.laporan.index', $data);
    }

    public function print(Request $request)
    {
        $this->validate($request, [
            'field' => 'required|in:id,gaji,tunjangan,periode,tahun,tanggal,catatan',
            'order' => 'required|in:ASC,DESC',
            'limit' => 'required|integer|max:' . Penggajian::count(),
        ]);

        $data['penggajians'] = Penggajian::where('periode', 'like', "%$request->periode%")
        ->where('tahun', 'like', "%$request->tahun%")
        ->orderBy($request->field, $request->order)->limit($request->limit)->get();

        if(!$data['penggajians']->count()) {
            
            return back()->with('error', 'Data tidak ada!');
        }

        return view('penggajian.laporan.print', $data);
    }

    public function getGaji(Pegawai $pegawai)
    {
        return Absensi::where('pegawai_id', $pegawai->id)->where('jam_masuk', '!=', '')->where('jam_keluar', '!=', '')->get()->map(function($item) {
            $item->total_jam = \Carbon\Carbon::parse($item->jam_keluar)->diffInHours(\Carbon\Carbon::parse($item->jam_masuk));

            return $item;
        })->sum('total_jam') * env('APP_GAJI_PER_JAM');
    }

    public function getTotalJam(Pegawai $pegawai)
    {
        
        return $this->getGaji($pegawai) / env('APP_GAJI_PER_JAM');
    }
}
