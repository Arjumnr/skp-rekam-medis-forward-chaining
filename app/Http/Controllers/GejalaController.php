<?php

namespace App\Http\Controllers;

use App\Models\ModelGejala;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class GejalaController extends Controller
{
    public function index(Request $request){
        $title = 'Gejala';
        // $role = Auth::user()->role;
        $data = ModelGejala::all()->sortByDesc('id');
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

        return view('admin.gejala.index', compact('title'));

    }

    public function store(Request $request)
    {
        try {

            ModelGejala::updateOrCreate(
                ['id' => $request->data_id],
                [
                    'kode_gejala' => $request->kode_gejala,
                    'des_gejala' => $request->des_gejala,
                    'cf_gejala' => $request->cf_gejala  ,
                ]
            );
            return response()->json(['status' => 'success', 'message' => 'Save data successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $data = ModelGejala::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        try {
            ModelGejala::find($id)->delete();
            return response()->json(['status' => 'success', 'message' => 'Data deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
