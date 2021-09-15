<?php

namespace App\Http\Controllers;

use App\Models\ReportCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReportCategoryController extends Controller
{


    function viewCreate()
    {
        return view('report.category.create_category');
    }

    function viewUpdate($id)
    {
        $category = ReportCategory::findOrFail($id);
        return view('report.category.admin_edit')->with(compact('category'));
    }

    function update($id, Request $request)
    {
        $category = ReportCategory::findOrFail($id);
        $category->category_name = $request->title;

        // dd($request->all());

        if ($request->hasFile('icon')) {

            $file_path = public_path() . $category->photo_path;
            if (file_exists($file_path)) {
                unlink($file_path);
            }

            $file = $request->file('icon');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;

            $savePath = "/web_files/category/";
            $savePathDB = "/web_files/category/$fileName";
            $path = public_path() . "$savePath";
            $upload = $file->move($path, $fileName);

            $category->category_name = $request->title;
            $category->photo_path = $savePathDB;
        }
        $category->save();


        if ($category) {
            return back()->with(["success" => "Berhasil Mengupdate Category"]);
        } else {
            return back()->with(["error" => "Gagal Menghapus Category"]);
        }
    }


    function viewManage(Request $request)
    {
        $data = ReportCategory::select('*')
            ->where('deleted_at', '=', null)
            ->orderBy('created_at', 'ASC');
        if ($request->ajax()) {
            $data = ReportCategory::select('*')
                ->where('deleted_at', '=', null)
                ->orderBy('created_at', 'ASC');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('img', function ($row) {
                    $link = url('/') . "$row->photo_path";
                    $img = '  <img class="center-cropped rounded mycat" src="' . $link . '" alt="">';
                    return $img;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-flex"><a href="' . url("/report_category/$row->id/edit") . '" id="' . $row->id . '" class="btn btn-primary btn-sm ml-2">Edit/Lihat Detail</a>';
                    $btn .= '<a href="javascript:void(0)" id="' . $row->id . '" class="btn btn-danger btn-sm ml-2 btn-delete">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action', 'img'])
                ->make(true);
        }
        return view('report.category.admin_manage');
    }

    function destroy($id)
    {
        $object = ReportCategory::findOrFail($id);
        $object->deleted_at = time();
        $object->save();
    }

    function store(Request $request)
    {

        $category  = new ReportCategory();

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;

            $savePath = "/web_files/category/";
            $savePathDB = "/web_files/category/$fileName";
            $path = public_path() . "$savePath";
            $upload = $file->move($path, $fileName);

            $category->category_name = $request->title;
            $category->photo_path = $savePathDB;
            $category->save();

            if ($category) {
                return back()->with(["success" => "Berhasil Menambah Category"]);
            } else {
                return back()->with(["error" => "Gagal Menambah Category"]);
            }
        }
    }




    // <---------------------------------------------------------> 
    // <----------------------- FOR API -------------------------> 

    function getCategory()
    {

        $category = ReportCategory::all();

        $response = [
            'message' => "success",
            'message_id' => "success",
            'http_response' => 200,
            'status_code' => 1,
            'size' => $category->count(),
            'data' => $category,
        
        ];

        return response()->json(
            $response
        );
    }
}
