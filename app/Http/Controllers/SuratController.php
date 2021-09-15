<?php

namespace App\Http\Controllers;

use App\Models\AnggotaKeluarga;
use App\Models\CapTtdRT;
use App\Models\CapTtdRW;
use App\Models\Keluarga;
use App\Models\RukunTetangga;
use App\Models\RukunWarga;
use App\Models\Surat;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratController extends Controller
{
    function checkIfRTAuthourized($id)
    {
        if (Auth::guard('erte')->check()) {
            if (Auth::guard('erte')->id() != $id) {
                return false;
            } else {
                return true;
            }
        }else{
            return true;
        }
    }
    function checkIfRWAuthourized($id)
    {
        if (Auth::guard('erwe')->check()) {
            if (Auth::guard('erwe')->id() != $id) {
                return false;
            } else {
                return true;
            }
        }else{
            return true;
        }
    }



    public function viewInitKeluargaCreate($id)
    {

        if (Auth::guard('keluarga')->check()) {
            $keluarga = Keluarga::findOrFail(Auth::guard('keluarga')->id());
            if ($keluarga->photo_kartu_keluarga == null) {
                return redirect('/keluarga')->with(["error" => "Lengkapi Data Sebelum Membuat Surat Pengajuan"]);
            }
        }


        $keluarga = Keluarga::findOrFail($id);
        $allMember = AnggotaKeluarga::where('id_keluarga', '=', $id)->get();
        return view('surat.new_request')->with(compact('keluarga', 'allMember'));
    }


    public function viewTrackingByKeluarga($id)
    {
        $keluarga = Keluarga::findOrFail($id);
        $surat = Surat::where('id_keluarga', '=', $id)->orderBy('id', 'DESC')->get();
        return view('surat.tracking')->with(compact('keluarga', 'surat'));
    }

    // View Edit Surat By RT
    // ID Disini menandakan id rt
    public function viewTrackingByRT($id)
    {
        if (!$this->checkIfRTAuthourized($id)) {
            return abort(403);
        }

        $keluarga = Keluarga::findOrFail($id);
        $surat = Surat::where('id_rt', '=', $id)->orderBy('id', 'DESC')->get();
        return view('surat.tracking')->with(compact('keluarga', 'surat'));
    }

    // View Edit Surat By RW
    // ID Disini menandakan id rw
    public function viewTrackingByRW($id)
    {
        if (!$this->checkIfRWAuthourized($id)) {
            return abort(403);
        }

        $surat = Surat::where('id_rw', '=', $id)->orderBy('id', 'DESC')->get();
        return view('surat.tracking')->with(compact('surat'));
    }

    // View Edit Surat By Admin
    public function viewTrackingByAdmin()
    {
        $surat = Surat::where('status', '=', 1)->orderBy('id', 'DESC')->get();
        return view('surat.tracking')->with(compact('surat'));
    }

    // View Create Surat By Keluarga , 
    // Keluarga hanya bisa menentukan anggota keluarga , keterangan, dan keperluan surat
    public function viewKeluargaCreate($id)
    {
        if (Auth::guard('keluarga')->check()) {
            $keluarga = Keluarga::findOrFail(Auth::guard('keluarga')->id());
            if ($keluarga->photo_kartu_keluarga == null) {
                return redirect('/keluarga')->with(["error" => "Lengkapi Data Sebelum Membuat Surat Pengajuan"]);
            }
        }

        $keluarga = Keluarga::findOrFail($id);
        $allMember = AnggotaKeluarga::where('id_keluarga', '=', $id)->get();
        return view('surat.new_request')->with(compact('keluarga', 'allMember'));
    }

    // View Edit Surat By Keluarga , 
    // Keluarga hanya bisa edit anggota, keperluan,dan keterangan
    public function viewEditKeluarga($id_keluarga, $id_surat)
    {
        $surat = Surat::findOrFail($id_surat);
        $keluarga = Keluarga::findOrFail($surat->id_keluarga);
        $warga = AnggotaKeluarga::findOrFail($surat->id_warga);
        $allMember = AnggotaKeluarga::where('id_keluarga', '=', $id_keluarga)->get();
        return view('surat.edit_surat_by_keluarga')->with(compact('keluarga', 'allMember', 'surat'));
    }

    // View Edit Surat By RT , RW , 
    public function viewEditRtRW($id_surat)
    {

        $surat = Surat::findOrFail($id_surat);
    
        $suratRWID = $surat->id_rw;
        $suratRTID = $surat->id_rt;
        
        if (!$this->checkIfRWAuthourized($suratRWID)) {
            return abort(403);
        }

        
        if (!$this->checkIfRTAuthourized($suratRTID)) {
            return abort(403);
        }

        $keluarga = Keluarga::findOrFail($surat->id_keluarga);
        $warga = AnggotaKeluarga::findOrFail($surat->id_warga);
        return view('surat.edit_surat_by_rt_rw')->with(compact('keluarga', 'surat', 'warga'));
    }

    // Simpan Surat, initial, asumsi : disimpan oleh keluarga, RT,RW,dan Admin Tidak Bisa 
    // Membuat Surat
    public function store(Request $request)
    {
        $rules = [
            "id_warga" => "required",
            "id_keluarga" => "required",
            "keperluan_surat" => "required",
            "keterangan" => "required",
        ];

        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request, $rules, $customMessages);

        $warga = AnggotaKeluarga::findOrFail($request->id_warga);
        $keluarga = Keluarga::findOrFail($request->id_keluarga);
        $rt = RukunTetangga::findOrFail($keluarga->rt);
        $rw = RukunWarga::findOrFail($rt->id_rw);

        $id_warga = $request->id;
        $object = new Surat();
        $object->keperluan = $request->keperluan_surat;
        $object->id_warga = $request->id_warga;
        $object->id_keluarga = $request->id_keluarga;
        $object->id_rw = $rw->id;
        $object->id_rt = $rt->id;
        $object->nama_lengkap = $warga->nama;
        $object->nik = $warga->nik;
        $object->alamat_pemohon = $warga->current_address;
        $object->tempat = $warga->tempat_lahir;
        $object->tanggal_lahir = $warga->tanggal_lahir;
        $object->pekerjaan = $warga->pekerjaan;
        $object->agama = $warga->agama;
        $object->status_perkawinan = $warga->status_perkawinan;
        $object->keterangan = $request->keterangan;
        $object->current_rt = $rt->kode;
        $object->sekretariat = $rt->alamat;
        $object->telepon = $rt->kontak;
        $object->nama_rt = $rt->nama;
        $object->nama_rw = $rw->nama;
        $object->current_rw = $rw->kode;
        $object->is_rt_approved = false;
        $object->is_rw_approved = false;
        $object->status = false;
        $object->save();

        if ($object) {
            return back()->with(["success" => "Berhasil Mengirim Pengajuan Surat"]);
        } else {
            return back()->with(["error" => "Gagal Mengirim Pengajuan Surat "]);
        }
    }


    // View Edit Surat By Keluarga , 
    // Keluarga hanya bisa edit anggota, keperluan,dan keterangan
    public function updateByKeluarga(Request $request, $id_keluarga, $id_surat)
    {
        $rules = [
            "id_warga" => "required",
            "keperluan_surat" => "required",
            "keterangan" => "required",
        ];

        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request, $rules, $customMessages);

        $warga = AnggotaKeluarga::findOrFail($request->id_warga);
        $keluarga = Keluarga::findOrFail($id_keluarga);
        $rt = RukunTetangga::findOrFail($keluarga->rt);
        $rw = RukunWarga::findOrFail($rt->id_rw);

        $object = Surat::findOrFail($id_surat);
        $object->keperluan = $request->keperluan_surat;
        $object->id_warga = $request->id_warga;
        $object->id_keluarga = $request->id_keluarga;
        $object->id_rw = $rw->id;
        $object->id_rt = $rt->id;
        $object->nama_lengkap = $warga->nama;
        $object->tempat = $warga->tempat_lahir;
        $object->tanggal_lahir = $warga->tanggal_lahir;
        $object->pekerjaan = $warga->pekerjaan;
        $object->agama = $warga->agama;
        $object->status_perkawinan = $warga->status_perkawinan;
        $object->keterangan = $request->keterangan;
        $object->current_rt = $rt->kode;
        $object->nama_rt = $rt->nama;
        $object->nama_rw = $rw->nama;
        $object->current_rw = $rw->kode;
        $object->is_rt_approved = false;
        $object->is_rw_approved = false;
        $object->status = false;
        $object->save();

        if ($object) {
            return back()->with(["success" => "Berhasil Mengupdate Data Pengajuan Surat (Keluarga)"]);
        } else {
            return back()->with(["error" => "Gagal Mengupdate Data Pengajuan Surat (Keluarga)"]);
        }
    }


    // Edit Data Surat By RT RW Keluarga ,
    // Disini Nama RT,RW,Alamat RT,RW,dimungkinkan berubah 
    // Keluarga hanya bisa edit anggota, keperluan,dan keterangan
    // Yang Tidak Bisa Diedit : Asal Keluarga
    public function updateByRtRw(Request $request, $id_surat)
    {
        $rules = [
            "nomor_surat" => "required",
            "nama_rt" => "required",
            "nama_rw" => "required",
            "status_rt" => "required",
            "status_rt" => "required",
            "keterangan" => "required",
        ];

        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];


        $this->validate($request, $rules, $customMessages);

        $object = Surat::findOrFail($id_surat);

        $object->keperluan = $request->keperluan_surat;
        $object->nama_rt = $request->nama_rt;
        $object->nomor_surat = $request->nomor_surat;
        $object->nama_rw = $request->nama_rw;

        if (Auth::guard('erte')->check()) {
            $pathTTD =CapTtdRT::where('type', '=', '1')->where('rt','=',$object->id_rt)->first();
            if ($pathTTD == null) {
                return back()->with(["error" => "Surat Belum Bisa diproses, RT Belum Melengkapi Tanda Tangan RT"]);
            }
            $pathCAP = CapTtdRT::where('type', '=', '2')->where('rt','=',$object->id_rt)->first();
            if ($pathCAP == null) {
                return back()->with(["error" => "Surat Belum Bisa diproses, RT Belum Melengkapi Stempel RT"]);
            }
            $object->id_cap_rt = $pathCAP->path;
            $object->id_ttd_rt = $pathTTD->path;
        }

        if (Auth::guard('erwe')->check()) {
            $pathTTD = CapTtdRW::where('type', '=', '1')->where('rw','=',$object->id_rw)->first();
            if ($pathTTD == null) {
                return back()->with(["error" => "Surat Belum Bisa diproses, RW Belum Melengkapi Tanda Tangan RW"]);
            }
            $pathCAP =CapTtdRW::where('type', '=', '2')->where('rw','=',$object->id_rw)->first();
            if ($pathCAP == null) {
                return back()->with(["error" => "Surat Belum Bisa diproses, RW Belum Melengkapi Stempel RW"]);
            }
            $object->id_cap_rw = $pathCAP->path;
            $object->id_ttd_rw = $pathTTD->path;
        }

        $object->is_rw_approved = $request->status_rw;
        $object->is_rt_approved = $request->status_rt;


        if ($object->is_rt_approved && $object->is_rw_approved) {
            $object->status = true;
        } else {
            $object->status = false;
        }
        $object->save();

        if ($object) {
            return back()->with(["success" => "Berhasil Mengupdate Data Pengajuan Surat (RT/RW)"]);
        } else {
            return back()->with(["error" => "Gagal Mengupdate Data Pengajuan Surat (RT/RW)"]);
        }
    }
}
