<?php

namespace App\Http\Controllers;

use App\Models\ModelPasien;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PasienController extends Controller
{
    public function index(Request $request){
        $title = 'Pasien';
        // $role = Auth::user()->role;
        $data = ModelPasien::all()->sortByDesc('id');
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Edit" class="edit "> <button type="button" class="btn rounded-pill btn-icon btn-primary">
                        <span class="tf-icons bx bx-message-square-edit"></span>
                      </button></a>';
                    $btn = $btn . ' <button type="button"  data-id="' . $row->id . '" class="btn rounded-pill btn-icon btn-danger delete">
                    <span class="tf-icons bx bx-trash-alt"></span>
                  </button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.pasien.index', compact('title'));

    }

    public function store(Request $request)
    {
        try {

            ModelPasien::updateOrCreate(
                ['id' => $request->data_id],
                [
                    'nama_lengkap' => $request->nama_lengkap,
                    'ttl' => $request->ttl,
                    'jk' => $request->jk,
                    'no_hp' => $request->no_hp,
                    'alamat' => $request->alamat,
                ]
            );
            return response()->json(['status' => 'success', 'message' => 'Save data successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $data = ModelPasien::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        try {
            ModelPasien::find($id)->delete();
            return response()->json(['status' => 'success', 'message' => 'Data deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
