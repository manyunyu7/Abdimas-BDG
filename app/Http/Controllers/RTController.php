<?php

namespace App\Http\Controllers;

use App\Models\CapTtdRT;
use App\Models\CapTtdRW;
use App\Models\Keluarga;
use App\Models\RukunTetangga;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RTController extends Controller
{

    function checkIfAuthourized($id)
    {
        if (Auth::guard('erte')->check()) {
            if (Auth::guard('erte')->id() != $id) {
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }
    
    function viewListKeluarga($id)
    {
        if (!$this->checkIfAuthourized($id)) {
            return abort(403);
        }
        $rt = RukunTetangga::findOrFail($id);
        $keluarga  = Keluarga::where('rt', '=', $id)->get();
        return view('rt.list_keluarga')->with(compact('rt', 'keluarga'));
    }

    function listKeluarga()
    {
        return Keluarga::all();
    }

    function getKeluargaAjax(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Keluarga::select('*')
                ->where('rt', '=', $id)
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
                ->rawColumns(['action', 'img', 'detail'])
                ->make(true);
        }
    }

    function viewChangePassword($id)
    {
        if (!$this->checkIfAuthourized($id)) {
            return abort(403);
        }
        $rt = RukunTetangga::findOrFail($id);
        return view('rt.change_password')->with(compact('rt'));
    }




    function viewManageTTD($id)
    {
        if (!$this->checkIfAuthourized($id)) {
            return abort(403);
        }

        $ttd = CapTtdRT::where('rt', '=', $id)->where('type', '=', '1')
            ->orderBy('id', 'DESC')->get();
        $rt = RukunTetangga::findOrFail($id);
        return view('rt.doc.ttd')->with(compact('rt', 'ttd'));
    }

    function viewManageCap($id)
    {
        if (!$this->checkIfAuthourized($id)) {
            return abort(403);
        }
        $cap = CapTtdRT::where('rt', '=', $id)->where('type', '=', '2')
            ->orderBy('id', 'DESC')->get();
        $rt = RukunTetangga::findOrFail($id);
        return view('rt.doc.cap')->with(compact('rt','cap'));
    }

    public function storeTTD(Request $request)
    {
        $rules = [
            'id_rt' => 'required',
            'photo' => 'required',
        ];

        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request, $rules, $customMessages);

        $target = RukunTetangga::findOrFail($request->id_rt);


        $object = new CapTtdRT();
        $object->rt = $request->id_rt;
        $object->type = "1";

        $photoPath = "";
        if ($request->hasFile('photo')) {

            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . $target->join_info . '.' . $extension;

            $savePath = "/web_files/ttd/rt/";
            $savePathDB = "/web_files/ttd/rt/$fileName";

            $path = public_path() . "$savePath";
            $file->move($path, $fileName);

            $object->path = $savePathDB;
        }


        $object->save();

        if ($object) {
            return back()->with(["success" => "Berhasil Menyimpan Tanda Tangan RT"]);
        } else {
            return back()->with(["error" => "Gagal Menyimpan Tanda Tangan RT"]);
        }
    }



    public function storeCap(Request $request)
    {
        $rules = [
            'id_rt' => 'required',
            'photo' => 'required',
        ];

        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request, $rules, $customMessages);

        $target = RukunTetangga::findOrFail($request->id_rt);

        $object = new CapTtdRT();
        $object->rt = $request->id_rt;
        $object->type = "2";

        if ($request->hasFile('photo')) {

            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . $target->join_info . '.' . $extension;

            $savePath = "/web_files/cap/rt/";
            $savePathDB = "/web_files/cap/rt/$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);

            $object->path = $savePathDB;
        }


        $object->save();

        if ($object) {
            return back()->with(["success" => "Berhasil Menambah Stempel RT"]);
        } else {
            return back()->with(["error" => "Gagal Menambah Stempel RT"]);
        }
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
}
