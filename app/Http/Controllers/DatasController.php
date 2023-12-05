<?php

namespace App\Http\Controllers;

use App\Models\ModelCF;
use App\Models\ModelDatas;
use App\Models\ModelGejala;
use App\Models\ModelPasien;
use App\Models\ModelRule;
use App\Models\ModelTindakan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DatasController extends Controller
{
    public function index(Request $request){
        $title = 'Datas';
        // $role = Auth::user()->role;
        $data = ModelDatas::with('get_pasien')->orderByDesc('id')->get();
        $dataRule = ModelRule::all()->sortByDesc('id');

        $dataCf = ModelCF::all()->sortByDesc('id');
        $dataPasien = ModelPasien::all()->sortByDesc('id');
            // return response()->json($dataPasien);

        $dataGejala = ModelGejala::all()->sortByDesc('id');
        

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // return response()->json($row->id);

                    // $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Edit" class="edit "> <button type="button" class="btn rounded-pill btn-icon btn-primary">
                    //     <span class="tf-icons bx bx-message-square-edit"></span>
                    //   </button></a>';
                    $btn = ' <button type="button"  data-id="' . $row->id . '" class="btn rounded-pill btn-icon btn-danger delete">
                    <span class="tf-icons bx bx-trash-alt"></span>
                  </button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
            // return response()->json($data);

        // return view('admin.datas.index', compact('title'));
        return view('admin.datas.index', compact('title', 'dataPasien', 'dataGejala', 'dataRule', 'dataCf'));

    }

    public function store(Request $request)
    {
        // return response()->json($request->all());
        $kode_gejala[] = $request->gejala_kode;
        $cf_user[] = $request->cf_user;
        $ruleTindakan = [];
        $ruleGejala = [];
        $dataRule = ModelRule::all()->sortByDesc('id');
        // return response()->json($dataRule);
        $tindakanKode = null;
        $CFpakar =[];
        // return response()->json($kode_gejala);

        // $selectedGejalaKode = $request->gejala_kode;

        // // Convert the array to a comma-separated string
        // $gejalaKodeString = implode(',', $selectedGejalaKode);
        try {
            //kodisikan data rule yang berisi tindakan kode apa sama dengan kode gejala
        foreach ($dataRule as $key  => $value) {
            foreach ($dataRule as $key2  => $value2) {
                $ruleTindakan[] = $value2->tindakan_kode;
                $ruleGejala[] = $value2->gejala_kode;
            }
            
            if (explode(',', $ruleGejala[$key]) == $kode_gejala[0]) {
                $tindakanKode = $ruleTindakan[$key];
            }
        }

        foreach ($kode_gejala[0] as $key => $value) {
            $CFpakar[] = ModelGejala::where('kode_gejala', $value)->first()->cf_gejala;
        }

        //cf_user to float
        $CFuser = [];
        foreach($cf_user[0] as $key => $value){
            $CFuser[] = floatval($value);
        }
        
        //kalikan CF pakar dengan CF user
        $CFsementara = [];
        foreach($CFpakar as $key => $value){
            $CFsementara[] = $value * $CFuser[$key];
        }

        $total_cf = 0.0;
        $i=0;
        // $CFlama = $CFsementara[0];

        // return response()->json($CFsementara);
        // total_cf = (𝐶𝐹𝑙𝑎𝑚𝑎, 𝐶𝐹𝑏𝑎𝑟𝑢) = 𝐶𝐹𝑙𝑎𝑚𝑎 + 𝐶𝐹𝑏𝑎𝑟𝑢 * (1 − 𝐶F𝑙𝑎𝑚𝑎)
        foreach($CFsementara as $key){
            $i++;
            if ($i == count($CFsementara)) {
                $total_cf = $total_cf + $CFsementara[$key] * (1 - $total_cf);
                // return response()->json([
                //     'total_cf' => $total_cf 
                // ]);
            }else{
                $total_cf = $CFsementara[$key] + $CFsementara[$key+1] * (1 - $CFsementara[$key]);
               
                $total_cf = $total_cf + $CFsementara[$key+1] * (1 - $total_cf);
                // return response()->json([
                //     'total_cf' => $total_cf,
                // ]);
            }
            
            $total_cf = round($total_cf, 3);

            // return response()->json([
            //     'total_cf' => $total_cf
            // ]);
            // $total_cf 

        }

        //jika tidak ada data yang null
        if ($total_cf != null && $tindakanKode != null) {
            ModelDatas::updateOrCreate(
                ['id' => $request->data_id],
                [
                    'pasien_id' => $request->pasien_id,
                    'data_terapis' => json_encode(
                        [
                            'gejala' => $kode_gejala,
                            'cf' => $cf_user,
                            'kode_tindakan' => $tindakanKode,
                            'total_cf' => $total_cf
    
                        ]
                    ),
                ]
            );
            return response()->json(['status' => 'success', 'message' => 'Save data successfully.']);

        }else{
            return response()->json(['status' => 'error', 'message' => 'Save data failed.']);
        }
      
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage(), 'line' => $e->getLine()]);
        }
    }

    public function edit($id)
    {
        $data = ModelDatas::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        try {
            ModelDatas::find($id)->delete();
            return response()->json(['status' => 'success', 'message' => 'Data deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
