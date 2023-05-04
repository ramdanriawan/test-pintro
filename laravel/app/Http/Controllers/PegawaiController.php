<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['pegawais'] = Pegawai::all();
        $data['jabatans'] = Jabatan::all();

        return view('pegawai.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['jabatans'] = Jabatan::all();

        return view('pegawai.create', $data);
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
            'nip'      => 'required|max:30',
            'nama'      => 'required|max:30',
            'tanggal_lahir' => 'required|max:11',
            'tempat_lahir'      => 'required|max:50',
            'jenis_kelamin' => 'required|in:Laki - Laki,Perempuan',
            'agama' => 'required|in:Islam,Kristen Katolik,Kristen Protestan,Hindu,Budha',
            'alamat'      => 'required',
            'no_telp'      => 'required|max:15',
            'tgl_mulai_kerja'      => 'required|max:11',
            'status' => 'required|in:Aktif,Tidak Aktif'
        ]);

        \DB::transaction(function() use($request) { 
            $pegawai = Pegawai::create($request->all());

            User::create([
                'name' => 'Guru' . $pegawai->no_telp,
                'email' => 'guru' . $pegawai->no_telp . '@gmail.com',
                'password' => $pegawai->tanggal_lahir,
            ]);
        });

        return redirect()->route('pegawai.index')->with('success', 'Berhasil menambah pegawai');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        $data['pegawai'] = $pegawai;
        
        return view('pegawai.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        $data['jabatans'] = Jabatan::all();
        $data['pegawai'] = $pegawai;

        return view('pegawai.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $this->validate($request, [
            'nip'      => "required|max:30|unique:pegawai,nip,$pegawai->nip,nip",
            'nama'      => 'required|max:30',
            'tanggal_lahir' => 'required|max:11',
            'tempat_lahir'      => 'required|max:50',
            'jenis_kelamin' => 'required|in:Laki - Laki,Perempuan',
            'agama' => 'required|in:Islam,Kristen Katolik,Kristen Protestan,Hindu,Budha',
            'alamat'      => 'required',
            'no_telp'      => 'required|max:15',
            'tgl_mulai_kerja'      => 'required|max:11',
            'status' => 'required|in:Aktif,Tidak Aktif'
        ]);

        $pegawai->update($request->all());

        return redirect()->route('pegawai.index')->with('success', 'Berhasil mengupdate pegawai');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus pegawai');
    }

    public function hapus_semua(Request $request)
    {
        $pegawais = Pegawai::whereIn('id', json_decode($request->ids, true))->get();

        Pegawai::whereIn('id', $pegawais->pluck('id'))->delete();

        return back()->with('success', 'Berhasil menghapus banyak data pegawai');
    }
    
    public function laporan()
    {
        $data['limit'] = Pegawai::count();
        
        return view('pegawai.laporan.index', $data);
    }

    public function print(Request $request)
    {
        $this->validate($request, [
            'field' => 'required|in:id,tanggal,jam_masuk,jam_keluar',
            'order' => 'required|in:ASC,DESC',
            'limit' => 'required|integer|max:' . Pegawai::count(),
        ]);

        $data['pegawais'] = Pegawai::where('jenis_kelamin', 'like', "%$request->jenis_kelamin%")
        ->where('agama', 'like', "%$request->agama%")
        ->where('status', 'like', "%$request->status%")
        ->orderBy($request->field, $request->order)->limit($request->limit)->get();

        if(!$data['pegawais']->count()) {
            
            return back()->with('error', 'Data tidak ada!');
        }

        return view('pegawai.laporan.print', $data);
    }
}
