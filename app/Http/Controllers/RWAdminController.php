<?php

namespace App\Http\Controllers;

use App\Models\RukunTetangga;
use App\Models\RukunWarga;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RWAdminController extends Controller
{
    function viewAdminManage(Request $request)
    {
        if ($request->ajax()) {
            $data = RukunWarga::select('*')
                ->orderBy('created_at', 'ASC');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('img', function ($row) {
                    $img = '  <img class="center-cropped rounded" src="' . "ss" . '" alt="">';
                    return $img;
                })
                ->addColumn('rt', function ($row) {
                    $countRT = RukunTetangga::where('id_rw','=',$row->id)->count();
                    return $countRT;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-flex"><a href="' . url("rw/$row->id/edit") . '" id="' . $row->id . '" class="btn btn-primary btn-sm ml-2">Edit/Lihat Detail</a>';
                    $btn .= '<a href="javascript:void(0)" id="' . $row->id . '" class="btn btn-danger btn-sm ml-2 btn-delete">Delete</a>';
                    return $btn;
                })
                ->addColumn('warga', function ($row) {
                    $btn = '<div class="d-flex"><a href="' . url("rw/$row->id/edit") . '" id="' . $row->id . '" class="btn btn-primary btn-sm ml-2">Edit/Lihat Detail</a>';
                    $btn .= '<a href="javascript:void(0)" id="' . $row->id . '" class="btn btn-danger btn-sm ml-2 btn-delete">Delete</a>';
                    return $btn;
                })
                
                ->rawColumns(['action', 'img','warga'])
                ->make(true);
        }

        return view('rw.admin_manage');
    }

    function viewEdit(Request $request, $id)
    {
        $rw = RukunWarga::findOrFail($id);
        return view('rw.admin_edit')->with(compact('rw'));
    }


    function insertAjax(Request $request)
    {
        $object = new RukunWarga();
        $object->kode = $request->kode;
        $object->kontak = $request->contact;
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

    function deleteAjax(Request $request,$id){
        $object = RukunWarga::findOrFail($id);
        $object->delete();
        if($object){
            return 1;
        }else{
            return 0;
        }
    }

    function update(Request $request, $id)
    {
        $rules = [
            "kode" => "required",
            "contact" => "required",
        ];
        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

     

        $this->validate($request, $rules, $customMessages);

        if (RukunWarga::where("kontak",'=',$request->contact)->where('id','<>',$id)->count()>0) {
            return back()->with(["error" => "Gagal Mengupdate Data, Kontak Sudah Digunakan Pada RW Lain"]);
        }
        if (RukunWarga::where("kode",'=',$request->kode)->where('id','<>',$id)->count()>0) {
            return back()->with(["error" => "Gagal Mengupdate Data, Kode RW Sudah Digunakan Pada RW Lain"]);
        }
        
        $object = RukunWarga::findOrFail($id);
        $object->kode = $request->kode;
        $object->nama = $request->nama;
        $object->kontak = $request->contact;
        $object->save();

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

        $object = RukunWarga::findOrFail($id);
        $object->password = bcrypt($request->new_password);
        $object->save();

        if ($object) {
            return back()->with(["success" => "Berhasil Mengupdate Password RW"]);
        } else {
            return back()->with(["error" => "Gagal Mengupdate Password RW"]);
        }
    }
}
