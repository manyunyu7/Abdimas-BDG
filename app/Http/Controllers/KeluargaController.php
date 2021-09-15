<?php

namespace App\Http\Controllers;

use App\Models\AnggotaKeluarga;
use App\Models\Keluarga;
use App\Models\RukunTetangga;
use App\Models\RukunWarga;
use App\Models\Surat;
use Barryvdh\DomPDF\Facade as PDF;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class KeluargaController extends Controller
{
    
    
    function checkIfAuthourized($id)
    {
        if (Auth::guard('keluarga')->check()) {
            if (Auth::guard('keluarga')->id() != $id) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
    


    function checkIfKeluargaDocumentComplete()
    {
        if (Auth::guard('keluarga')->check()) {
            $keluarga = Keluarga::findOrFail(Auth::guard('keluarga')->id());
            if ($keluarga->photo_kartu_keluarga == null) {
                return redirect('/keluarga')->with(['errors' => "Lengkapi Data Terlebih Dahulu"]);
            }
        }
    }

    public function dashboard()
    {
        
        $getRT = RukunTetangga::all();

        $rt = array();
        foreach ($getRT as $key) {
            $rw = RukunWarga::find($key->id_rw);
            $rt[] = [
                "id_rt" => $key->id,
                "kode_rt" => $key->kode,
                "kontak" => $key->kontak,
                "id_rw" => $rw->id,
                "kode_rw" => $rw->kode,
            ];
        }

        $keluarga = Keluarga::find(Auth::guard('keluarga')->id());
        $widget = [
            "keluarga" => $keluarga,
            "rt" => $rt,
        ];
        return view('keluarga.dashboard.home')->with(compact('widget'));
    }



    public function keluargaRegister(Request $request)
    {
        $rules = [
            'nama' => 'required',
            'rt' => 'required',
            'kontak' => 'required|numeric',
            'alamat' => 'required',
            'password' => 'required',
        ];

        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request, $rules, $customMessages);


        $object = new Keluarga();
        $object->nama = $request->nama;
        $object->rt = $request->rt;
        $object->kontak = $request->kontak;
        $object->password = bcrypt($request->password);
        $object->alamat = $request->alamat;
        $object->save();

        if ($object) {
            return back()->with(["success" => "Berhasil Mendaftarkan Keluarga, Silakan Login Dengan Kontak $object->kontak dan password saat registrasi"]);
        } else {
            return back()->with(["error" => "Gagal Mendaftar, Hubungi Admin atau Silakan Coba Lagi Nanti"]);
        }

        // id	nama	password	no_kk	kontak	alamat	photo_kartu_keluarga	rt	
        return $request->all();
    }

    function isRTExist($id)
    {
        if (RukunTetangga::find($id) == null) {
            return false;
        } else {
            return true;
        }
    }


    public function keluargaUpdate(Request $request)
    {
        $id = ($request->id);
        $rules = [
            'nama' => 'required',
            'rt' => 'required',
            'kontak' => 'required|numeric',
            'alamat' => 'required',
        ];

        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request, $rules, $customMessages);


        $object = Keluarga::find($id);

        if ($object == null) {
            return back()->with(["error" => "ID Keluarga Tidak Ditemukan"]);
        }

        $object->nama = $request->nama;
        $object->rt = $request->rt;
        $object->kontak = $request->kontak;
        $object->alamat = $request->alamat;
        $object->save();

        if ($object) {
            return back()->with(["success" => "Berhasil Mengupdate Data Keluarga"]);
        } else {
            return back()->with(["error" => "Gagal Mengupdate Data Keluarga"]);
        }

        // id	nama	password	no_kk	kontak	alamat	photo_kartu_keluarga	rt	
        return $request->all();
    }

    function changeKKPhoto(Request $request, $id_kel)
    {
        $id = $request->id;
        if ($id == null) {
            $id = $id_kel;
        }
        $user = Keluarga::findOrFail($id);

        if ($request->hasFile('photo')) {
            $file_path = public_path() . $user->photo_path;
            if (file_exists($file_path)) {
                try {
                    unlink($file_path);
                } catch (Exception $e) {
                }
            }

            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = $user->id . '.' . $extension;

            $savePath = "/web_files/photo_kk/$id/";
            $savePathDB = "/web_files/photo_kk/$id/$fileName";
            $path = public_path() . "$savePath";
            $upload = $file->move($path, $fileName);

            $user->photo_kartu_keluarga = $savePathDB;
            $user->save();

            if ($user) {
                return back()->with(["success" => "Berhasil Mengupdate Foto Kartu Keluarga"]);
            } else {
                return back()->with(["error" => "Gagal Mengupdate Foto Kartu Keluarga"]);
            }
        }
    }


    //member section

    public function storeMember(Request $request, $id_kel)
    {
        $id = ($request->id);
        if ($id == null) {
            $id = $id_kel;
        }
        $rules = [
            'nama' => 'required',
            'nik' => 'required',
            'gender' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'status_nikah' => 'required',
            'agama' => 'required',
            'pendidikan' => 'required',
            'pekerjaan' => 'required',
        ];

        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request, $rules, $customMessages);


        $photoPath = "";
        if ($request->hasFile('photo')) {

            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;

            $savePath = "/web_files/anggota_keluarga/";
            $savePathDB = "/web_files/anggota_keluarga/$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);

            $photoPath = $savePathDB;
        }


        $object = new AnggotaKeluarga();
        $object->nik = $request->nik;
        $object->id_keluarga = $id;
        $object->nama = $request->nama;
        $object->gender = $request->gender;
        $object->tempat_lahir = $request->tempat_lahir;
        $object->tanggal_lahir = $request->tanggal_lahir;
        $object->status_perkawinan = $request->status_nikah;
        $object->agama = $request->agama;
        $object->pendidikan = $request->pendidikan;
        $object->pekerjaan = $request->pekerjaan;
        $object->current_address = $request->alamat;
        $object->path_ktp = $photoPath;

        $object->save();

        if ($object) {
            return back()->with(["success" => "Berhasil Menambah Anggota Keluarga"]);
        } else {
            return back()->with(["error" => "Gagal Menambah Anggota Keluarga"]);
        }
    }

    public function updateMember(Request $request, $id)
    {
        $object = AnggotaKeluarga::findOrFail($id);

        $id = ($request->id);
        $rules = [
            'nama' => 'required',
            'nik' => 'required',
            'gender' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'status_nikah' => 'required',
            'agama' => 'required',
            'pendidikan' => 'required',
            'pekerjaan' => 'required',
        ];

        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request, $rules, $customMessages);

        $photoPath = $object->path_ktp;
        if ($request->hasFile('photo')) {
            $file_path = public_path() . $object->path_ktp;
            if (file_exists($file_path)) {
                try {
                    unlink($file_path);
                } catch (Exception $e) {
                }
            }

            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;

            $savePath = "/web_files/anggota_keluarga/";
            $savePathDB = "/web_files/anggota_keluarga/$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);

            $photoPath = $savePathDB;
        }


        $object = AnggotaKeluarga::find($id);
        $object->nik = $request->nik;
        $object->id_keluarga = $request->id;
        $object->nama = $request->nama;
        $object->gender = $request->gender;
        $object->tempat_lahir = $request->tempat_lahir;
        $object->id_keluarga = $request->id_keluarga;
        $object->tanggal_lahir = $request->tanggal_lahir;
        $object->agama = $request->agama;
        $object->status_perkawinan = $request->status_nikah;
        $object->pendidikan = $request->pendidikan;
        $object->pekerjaan = $request->pekerjaan;
        $object->current_address = $request->alamat;
        $object->path_ktp = $photoPath;

        $object->save();

        if ($object) {
            return back()->with(["success" => "Berhasil Mengupdate Data Anggota Keluarga"]);
        } else {
            return back()->with(["error" => "Gagal Mengupdate Data Anggota Keluarga"]);
        }
    }

    public function viewAddMember(Request $request, $id)
    {
        if (Auth::guard('keluarga')->check()) {
            $keluarga = Keluarga::findOrFail(Auth::guard('keluarga')->id());
            if ($keluarga->photo_kartu_keluarga == null) {
                return redirect('/keluarga')->with(["error" => "Lengkapi Data Sebelum Menambah Anggota Keluarga"]);
            }
        }

        if (!$this->checkIfAuthourized($id)) {
            return abort(403);
        }


        $keluarga = Keluarga::findOrFail($id);
        return view('anggota_keluarga.keluarga_add')->with(compact('keluarga'));
    }

    public function viewManageMember(Request $request, $id)
    {
        if (!$this->checkIfAuthourized($id)) {
            return abort(403);
        }

        $keluarga = Keluarga::findOrFail($id);
        return view('anggota_keluarga.keluarga_manage')->with(compact('keluarga'));
    }

    function viewEditMember(Request $request, $id)
    {
        
  

        
        $member = AnggotaKeluarga::findOrFail($id);

        $keluarga_id = $member->id_keluarga;
        if (!$this->checkIfAuthourized($keluarga_id)) {
            return abort(403);
        }
        $currentKeluargaId = $member->id_keluarga;
        $currentKeluarga = Keluarga::findOrFail($currentKeluargaId);
        $rt = RukunTetangga::all();
        $keluarga = Keluarga::where('rt', '=', $currentKeluarga->rt)->get();
        return view('anggota_keluarga.keluarga_edit')->with(compact('member', 'rt', 'keluarga', 'currentKeluarga'));
    }

    function viewAddNew(Request $request)
    {
        $rt = RukunTetangga::all();
        return view('keluarga.tambah_keluarga')->with(compact('rt'));
    }

    function viewDetailMember(Request $request, $id)
    {

        $member = AnggotaKeluarga::findOrFail($id);


        $keluarga_id = $member->id_keluarga;
        if (!$this->checkIfAuthourized($keluarga_id)) {
            return abort(403);
        }

        return view('anggota_keluarga.keluarga_see')->with(compact('member'));
    }

    function deleteMemberAjax(Request $request, $id)
    {
        $object = AnggotaKeluarga::findOrFail($id);
        $file_path = public_path() . $object->path_ktp;
        if (file_exists($file_path)) {
            try {
                unlink($file_path);
            } catch (Exception $e) {
                //Do Nothing
            }
        }

        $object->delete();

        if ($object) {
            return 1;
        } else {
            return 0;
        }
    }

    function getAnggotaAjax(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = AnggotaKeluarga::select('*')
                ->where('id_keluarga', '=', $id)
                ->orderBy('created_at', 'ASC');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('img', function ($row) {
                    $img = '  <img style="border-radius:10px !important" class="center-cropped rounded" src="' . url('/') . $row->path_ktp . '" alt="" ' .
                        "onerror='imgError(this);'>";
                    return $img;
                })
                ->addColumn('gender', function ($row) {
                    if ($row->gender == "1") {
                        return "Laki-Laki";
                    } else {
                        return "Perempuan";
                    }
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-flex"><a href="' . url("member/$row->id/edit") . '" id="' . $row->id . '" class="btn btn-primary btn-sm ml-2">Edit</a>';
                    $btn .= '<a href="javascript:void(0)" id="' . $row->id . '" class="btn btn-danger btn-sm ml-2 btn-delete">Delete</a>';
                    return $btn;
                })
                ->addColumn('detail', function ($row) {
                    $btn = '<div class="d-flex"><a href="' . url("member/$row->id/detail") . '" id="' . $row->id . '" class="btn btn-primary btn-sm ml-2">Lihat Detail</a>';
                    return $btn;
                })
                ->rawColumns(['action', 'gender', 'img', 'detail'])
                ->make(true);
        }
    }

    function viewChangePassword($id)
    {
        $keluarga = Keluarga::findOrFail($id);
        return view('keluarga.keluarga_change_password')->with(compact('keluarga'));
    }
    function viewInfo($id)
    {
        $keluarga = Keluarga::findOrFail($id);
        return view('keluarga.keluarga_info_see')->with(compact('keluarga'));
    }
    function viewEdit($id)
    {
        $keluarga = Keluarga::findOrFail($id);
        $rt = RukunTetangga::all();
        return view('keluarga.keluarga_info_edit')->with(compact('keluarga', 'rt'));
    }

    function changePassword($id, Request $request)
    {
        $user_id = $id;
        $this->validate($request, [
            'new_password' => 'required|min:6',
            'old_password' => 'required|min:6'
        ]);
        $user = Keluarga::findOrFail($user_id);
        $hasher = app('hash');

        //If Password Sesuai
        if (!$hasher->check($request->old_password, $user->password)) {
            return back()->with(["error" => "Password Lama Tidak Sesuai"]);
        } else {
            $user->password = Hash::make($request->new_password);
            $user->save();
            if ($user) {
                return back()->with(["success" => "Password Berhasil Diperbarui"]);
            } else {
                return back()->with(["error" => "Password Gagal Diperbarui"]);
            }
        }
    }

    function generatePDF($id)
    {
        $data = Surat::findOrFail($id);
        // $data = ['title'=>'hello wrold'];
        $pdf = PDF::loadView('surat.surat', $data);
        return $pdf->download('surat-pdf.pdf');
    }

    function generatePDFraw($id){
        $data = Surat::findOrFail($id);
        // $data = ['title'=>'hello wrold'];
        $pdf = PDF::loadView('surat.surat_template', $data);
        return $pdf->download('surat-pdf.pdf');
    }
}
