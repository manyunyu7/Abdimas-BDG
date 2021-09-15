<?php

namespace App\Http\Controllers;

use App\Models\RukunTetangga;
use App\Models\RukunWarga;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RTAdminController extends Controller
{
    function viewAdminManage(Request $request)
    {
        if ($request->ajax()) {
            $data = RukunTetangga::select('*')
                ->orderBy('created_at', 'ASC');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('img', function ($row) {
                    $img = '  <img class="center-cropped rounded" src="' . "ss" . '" alt="">';
                    return $img;
                })
                ->addColumn('rw', function ($row) {
                    $rw = RukunWarga::where('id', '=', $row->id_rw)->first()->kode;
                    return $rw;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-flex"><a href="' . url("rt/$row->id/edit") . '" id="' . $row->id . '" class="btn btn-primary btn-sm ml-2">Edit/Lihat Detail</a>';
                    $btn .= '<a href="javascript:void(0)" id="' . $row->id . '" class="btn btn-danger btn-sm ml-2 btn-delete">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action', 'rw'])
                ->make(true);
        }

        $rw = RukunWarga::all();

        return view('rt.admin_manage')->with(compact('rw'));
    }

    function viewEdit(Request $request, $id)
    {
        $rt = RukunTetangga::findOrFail($id);
        $rwList = RukunWarga::all();
        return view('rt.admin_edit')->with(compact('rt', 'rwList'));
    }


    function insertAjax(Request $request)
    {
        $object = new RukunTetangga();
        $object->kode = $request->kode;
        $object->kontak = $request->contact;
        $object->id_rw = $request->id_rw;
        $object->nama = $request->nama;
        $object->status = "active";
        $object->password = bcrypt($request->password);
        $object->save();

        $rw = RukunWarga::all()->count();
        if ($object) {
            return $rw;
        } else {
            return 0;
        }
    }

    function deleteAjax(Request $request, $id)
    {
        $object = RukunTetangga::findOrFail($id);
        $object->delete();
        if ($object) {
            return 1;
        } else {
            return 0;
        }
    }

    function update(Request $request, $id)
    {

        $rules = [
            "kode" => "required",
            "contact" => "required",
            "id_rw" => "required",
        ];
        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request, $rules, $customMessages);

        $object = RukunTetangga::findOrFail($id);
        $object->kode = $request->kode;
        $object->id_rw = $request->id_rw;
        $object->kontak = $request->contact;
        $object->nama= $request->nama;

        try {
            $object->save();
        } catch (Exception $e) {
            return back()->with(["error" => "Kode RT Sudah Digunakan Pada RW Yang Baru (Duplikat)"]);
        }

        if ($object) {
            return back()->with(["success" => "Berhasil Mengupdate Data"]);
        } else {
            return back()->with(["error" => "Gagal Mengupdate Data"]);
        }
    }

    function adminChangePassword(Request $request, $id)
    {
        $rules = [
            "new_password" => "required|min:6",
        ];
        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu',
            'min' => 'Jumlah Karakter Minimum Untuk :attribute adalah :min'
        ];

        $this->validate($request, $rules, $customMessages);

        $object = RukunTetangga::findOrFail($id);
        $object->password = bcrypt($request->new_password);
        $object->save();

        if ($object) {
            return back()->with(["success" => "Berhasil Mengupdate Password RT"]);
        } else {
            return back()->with(["error" => "Gagal Mengupdate Password RT"]);
        }
    }
}
