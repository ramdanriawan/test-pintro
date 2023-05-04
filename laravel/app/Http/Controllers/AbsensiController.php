<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Absensi;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Models\RiwayatJabatan;
use App\Http\Controllers\Controller;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['absensis'] = Absensi::orderBy('tanggal', 'desc')->paginate(1000)->reverse();

        return view('absensi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('absensi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $riwayat_jabatan_pegawai_ids = RiwayatJabatan::where('status', 'Aktif')->pluck('pegawai_id')->unique()->toArray();
        $pegawais = Pegawai::whereIn('id', $riwayat_jabatan_pegawai_ids)->get();

        foreach($pegawais as $pegawai) 
        {
            // kalo pegawai untuk hari ini belum ada maka tambahkan  jika sudah ada maka skip saja
            $pegawai_absen = Absensi::where([
                'pegawai_id' => $pegawai->id,
                'tanggal' => $request->tanggal
            ])->first();

            if($pegawai_absen) {
                
                continue;
            }

            Absensi::create([
                'pegawai_id' => $pegawai->id,
                'tanggal' => $request->tanggal,
                'jam_masuk' => '',
                'jam_keluar' => ''
            ]);
        }

        return redirect()->route('absensi.index')->with('success', 'Berhasil menambah data absen!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Absensi $absensi)
    {
        if(request()->absen_masuk) {

            $absensi->update([
                'jam_masuk' => Carbon::now()->format('H:i')
            ]);

            return redirect()->route('absensi.index')->with('success', 'Berhasil absen masuk');
        }
        
        if(request()->absen_keluar) {

            $absensi->update([
                'jam_keluar' => Carbon::now()->format('H:i')
            ]);

            return redirect()->route('absensi.index')->with('success', 'Berhasil absen keluar');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absensi $absensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absensi $absensi)
    {
        $absensi->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus absensi');
    }

    public function hapus_semua(Request $request)
    {
        $absensis = Absensi::whereIn('id', json_decode($request->ids, true))->get();

        Absensi::whereIn('id', $absensis->pluck('id'))->delete();

        return back()->with('success', 'Berhasil menghapus banyak data absensi');
    }
    
    public function laporan()
    {
        $data['limit'] = Absensi::count();
        
        return view('absensi.laporan.index', $data);
    }

    public function print(Request $request)
    {
        $this->validate($request, [
            'field' => 'required|in:id,tanggal,jam_masuk,jam_keluar',
            'order' => 'required|in:ASC,DESC',
            'limit' => 'required|integer|max:' . Absensi::count(),
        ]);

        $data['absensis'] = Absensi::orderBy($request->field, $request->order)->limit($request->limit)
        ->get()->filter(function($item) use($request) {
            $tanggal_awal = \Carbon\Carbon::parse($request->tanggal_awal);
            $tanggal_akhir = \Carbon\Carbon::parse($request->tanggal_akhir);

            return (\Carbon\Carbon::parse($item->tanggal)->gte($tanggal_awal) &&
            \Carbon\Carbon::parse($item->tanggal)->lte($tanggal_akhir));
        });

        $data['absensis'] = $data['absensis']->map(function($item) use($data) {
            
            $item->total_absen_masuk = $data['absensis']->where('jam_masuk', '!=', '')->where('pegawai_id', $item->pegawai_id)->count();
            $item->total_absen_keluar = $data['absensis']->where('jam_keluar', '!=', '')->where('pegawai_id', $item->pegawai_id)->count();

            return $item;
        })->unique('pegawai_id')->filter(function($item) { // untuk memfilter kalau seandainya yg login adalah guru
            if(preg_match('/guru/', auth()->user()->email)) {
                
                return 'guru' . $item->pegawai->no_telp . '@gmail.com' == auth()->user()->email;
            }

            return false;
        });

        if(!$data['absensis']->count()) {
            
            return back()->with('error', 'Data tidak ada!');
        }

        return view('absensi.laporan.print', $data);
    }
}
