<?php

namespace App\Http\Controllers;

use App\Models\kepalaprogram;
use App\Models\Prakerin;
use App\Http\Requests\StorekepalaprogramRequest;
use App\Http\Requests\UpdatekepalaprogramRequest;
use App\Models\Pembimbingsekolah;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KepalaprogramController extends Controller
{
    protected $Pilihps;
    protected $Ps;
    protected $Sp;
    public function __construct()
    {
        $this->Ps = Pembimbingsekolah::all();
        $this->Pilihps = Prakerin::all();
        $this->Sp = Pengajuan::all();
    }

    public function indexps()
    {
        return view('pilihps.index',[
            'title' => 'Pilih Pembimbing Perusahaan',
            'prakerin' => $this->Pilihps
        ]);
    }

    public function editps($id_prakerin)
    {       
        $edit =  DB::table('prakerin')
        ->where('id_prakerin', $id_prakerin)
        ->select()
        ->get();
        return view('pilihps.edit', [
            'edit' => $edit,
            'pembimbing_sekolah' => $this->Ps
        ]);
    }

    public function updateps(Request $request)
    {
        $upd = DB::table('prakerin')
        -> where('id_prakerin', '=', $request->id_prakerin)
        -> update([
            'id_ps' => $request->id_ps
        ]);
        if ($upd) {
            return redirect('/pilihpembimbingsekolah');
        } else {
    
        }
    }

    public function indexsuratpengajuan()
    {
        return view('suratpengajuan.index',[
            'title' => 'Surat Pengajuan',
            'sp' => $this->Sp
        ]);
    }

    public function detailsuratpengajuan($id)
    {   
        $dataupdt = Pengajuan::all()->first();

        return view('suratpengajuan.edit', [
            'edit' => $dataupdt
        ]);
    }

    public function updateterima(Request $request)
    {
        $dataTerima = [
            'status_pengajuan' => $request->status_pengajuan,
            'bukti_terima' => $request->keterangan
        ];
        $upd = DB::table('pengajuan')
        -> where('id_pengajuan', $request->input('id_pengajuan'))
        -> update($dataTerima);
        // dd($dataTerima);
        if ($upd) {
            return redirect('/suratpengajuan');
        } else {
    
        }
    }

    public function updatetolak(Request $request)
    {
        $dataTolak = [
            'status_pengajuan'   => $request->status_pengajuan,
            'bukti_terima' => $request->keterangan
        ];
        $upd = DB::table('pengajuan')
        -> where('id_pengajuan', $request->input('id_pengajuan'))
        -> update($dataTolak);
        if ($upd) {
            return redirect('/suratpengajuan');
        } else {
            return "update data gagal";
        }
    }

    public function hapussuratpengajuan(Request $request, $id_pengajuan)
    {
        $hapus = DB::table('pengajuan')
                        ->where('id_pengajuan', $request->$id_pengajuan)
                        ->delete();

        if($hapus){
            return redirect('/suratpengajuan');
        }
    }
}