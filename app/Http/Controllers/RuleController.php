<?php

namespace App\Http\Controllers;

use App\Models\ModelGejala;
use App\Models\ModelRule;
use App\Models\ModelTindakan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RuleController extends Controller
{
    public function index(Request $request){
        $title = 'Rule';
        // $role = Auth::user()->role;
        $data = ModelRule::all()->sortByDesc('id');
        $dataTindakan = ModelTindakan::all()->sortByDesc('id');
        $dataGejala = ModelGejala::all()->sortByDesc('id');
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

        return view('admin.rule.index', compact('title', 'dataTindakan', 'dataGejala'));

    }

    public function store(Request $request)
    {
        $selectedGejalaKode = $request->gejala_kode;

        // Convert the array to a comma-separated string
        $gejalaKodeString = implode(',', $selectedGejalaKode);
        try {
            ModelRule::updateOrCreate(
                ['id' => $request->data_id],
                [
                    'tindakan_kode' => $request->tindakan_kode,
                    'gejala_kode' => $gejalaKodeString,
                ]
            );
            return response()->json(['status' => 'success', 'message' => 'Save data successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $data = ModelRule::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        try {
            ModelRule::find($id)->delete();
            return response()->json(['status' => 'success', 'message' => 'Data deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
