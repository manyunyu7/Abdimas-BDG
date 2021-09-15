<?php

namespace App\Http\Controllers;

use App\Models\CapTtdRW;
use Illuminate\Http\Request;
use App\Models\Keluarga;
use App\Models\RukunTetangga;
use App\Models\RukunWarga;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class RWController extends Controller
{

    function checkIfAuthourized($id)
    {
        if (Auth::guard('erwe')->check()) {
            if (Auth::guard('erwe')->id() != $id) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
    


    function viewListKeluarga($id){
        $rw = RukunWarga::findOrFail($id);
        $keluarga  = Keluarga::where('rw','=',$id)->get();
        return view('rw.list_keluarga')->with(compact('rw','keluarga'));
    }

    function listKeluarga(){
        return Keluarga::all();
    }

    function getKeluargaAjax(Request $request,$id)
    {
        if ($request->ajax()) {
            $data = Keluarga::select('*')
                ->where('rw', '=', $id)
                ->orderBy('created_at', 'ASC')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('img', function ($row) {
                    $img = '  <img style="border-radius:10px !important" class="center-cropped rounded" src="' . url('/') . $row->photo_kartu_keluarga . '" alt="">';
                    return $img;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-flex"><a href="' . url("keluarga/$row->id/edit") . '" id="' . $row->id . '" class="btn btn-primary btn-sm ml-2">Edit</a>';
                    $btn .= '<a href="javascript:void(0)" id="' . $row->id . '" class="btn btn-danger btn-sm ml-2 btn-delete">Delete</a>';
                    return $btn;
                })
                ->addColumn('detail', function ($row) {
                    $btn = '<div class="d-flex"><a href="' . url("keluarga/$row->id/detail") . '" id="' . $row->id . '" class="btn btn-primary btn-sm ml-2">Lihat Detail</a>';
                    return $btn;
                })
                ->rawColumns(['action','img','detail'])
                ->make(true);
        }
    }

    function viewChangePassword($id)
    {
        $rw = RukunWarga::findOrFail($id);
        return view('rw.change_password')->with(compact('rw'));
    }

    #Lihat RT Anggota
    function viewMember($id)
    {
        if (!$this->checkIfAuthourized($id)) {
            return abort(403);
        }
        
        $rt = RukunTetangga::where('id_rw','=',$id)->get();
        $rw = RukunWarga::findOrFail($id);
        return view('rw.see_rt_member')->with(compact('rt','rw'));
    }

    function viewManageTTD($id)
    {
        if (!$this->checkIfAuthourized($id)) {
            return abort(403);
        }

        $ttd = CapTtdRW::where('rw', '=', $id)->where('type', '=', '1')
            ->orderBy('id', 'DESC')->get();
        $rw = RukunWarga::findOrFail($id);
        return view('rw.doc.ttd')->with(compact('rw', 'ttd'));
    }

    function viewManageCap($id)
    {
        if (!$this->checkIfAuthourized($id)) {
            return abort(403);
        }
        $cap = CapTtdRW::where('rw', '=', $id)->where('type', '=', '2')
            ->orderBy('id', 'DESC')->get();
        $rw = RukunWarga::findOrFail($id);
        return view('rw.doc.cap')->with(compact('rw','cap'));
    }

    public function storeTTD(Request $request)
    {
        $rules = [
            'id_rw' => 'required',
            'photo' => 'required',
        ];

        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request, $rules, $customMessages);

        $target = RukunWarga::findOrFail($request->id_rw);


        $object = new CapTtdRW();
        $object->rw = $request->id_rw;
        $object->type = "1";

        $photoPath = "";
        if ($request->hasFile('photo')) {

            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . $target->join_info . '.' . $extension;

            $savePath = "/web_files/ttd/rw/";
            $savePathDB = "/web_files/ttd/rw/$fileName";

            $path = public_path() . "$savePath";
            $file->move($path, $fileName);

            $object->path = $savePathDB;
        }


        $object->save();

        if ($object) {
            return back()->with(["success" => "Berhasil Menyimpan Tanda Tangan RW"]);
        } else {
            return back()->with(["error" => "Gagal Menyimpan Tanda Tangan RW"]);
        }
    }

    public function storeCap(Request $request)
    {
        $rules = [
            'id_rw' => 'required',
            'photo' => 'required',
        ];

        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request, $rules, $customMessages);

        $target = RukunWarga::findOrFail($request->id_rw);

        $object = new CapTtdRW();
        $object->rw = $request->id_rw;
        $object->type = "2";

        if ($request->hasFile('photo')) {

            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . $target->join_info . '.' . $extension;

            $savePath = "/web_files/cap/rw/";
            $savePathDB = "/web_files/cap/rw/$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);

            $object->path = $savePathDB;
        }


        $object->save();

        if ($object) {
            return back()->with(["success" => "Berhasil Menambah Stempel RW"]);
        } else {
            return back()->with(["error" => "Gagal Menambah Stempel RW"]);
        }
    }

    function changePassword($id, Request $request)
    {
        $user_id = $id;
        $this->validate($request, [
            'new_password' => 'required|min:6',
            'old_password' => 'required|min:6'
        ]);
        $user = RukunWarga::findOrFail($user_id);
        $hasher = app('hash');

        //If Password Sesuai
        if (!$hasher->check($request->old_password, $user->password)) {
            return back()->with(["error" => "Password Lama RW Tidak Sesuai"]);
        } else {
            $user->password = Hash::make($request->new_password);
            $user->save();
            if ($user) {
                return back()->with(["success" => "Password RW Berhasil Diperbarui"]);
            } else {
                return back()->with(["error" => "Password RW Gagal Diperbarui"]);
            }
        }
    }

}
