<?php

namespace App\Http\Controllers;

use App\Models\ModelTindakan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TindakanController extends Controller
{
    public function index(Request $request){
        $title = 'Tindakan';
        // $role = Auth::user()->role;
        $data = ModelTindakan::all()->sortByDesc('id');
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

        return view('admin.tindakan.index', compact('title'));

    }

    public function store(Request $request)
    {
        try {

            ModelTindakan::updateOrCreate(
                ['id' => $request->data_id],
                [
                    'kode_tindakan' => $request->kode_tindakan,
                    'nama_tindakan' => $request->nama_tindakan,
                ]
            );
            return response()->json(['status' => 'success', 'message' => 'Save data successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $data = ModelTindakan::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        try {
            ModelTindakan::find($id)->delete();
            return response()->json(['status' => 'success', 'message' => 'Data deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
