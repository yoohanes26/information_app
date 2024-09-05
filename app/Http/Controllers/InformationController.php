<?php

namespace App\Http\Controllers;

use App\Http\Helper\ApiFormatWeb;
use App\Models\AsmsInformation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\QueryBuilder\QueryBuilder;
use Yajra\DataTables\DataTables;

class InformationController extends Controller
{
    public function homepage(){
        $column_names = ['お知らせタイトル', 'お知らせ区分', '掲載日', '適用期日'];
        return view('information.list')->with('column_names', $column_names);
    }

    public function getInformation(){
//        $modelInformation = (new AsmsInformation)->newQuery();
//
//        $query = QueryBuilder::for($modelInformation)
//            ->allowedSorts(['id'])
//            ->paginate(100)
//            ->appends(request()->query());
//
//        return ApiFormatWeb::transform($query, ['name' => 'Major List', 'description' => 'List Major']);

        $modelInformation = AsmsInformation::get();

        return DataTables::of($modelInformation->map->format())->make();
    }

    public function createInformation(Request $request){
        $validator = Validator::make($request->all(), [
            'information_title' => 'required|string',
            'information_kbn' => 'required|boolean',
            'keisai_ymd' => 'required|date_format:Ymd',
            'enable_start_ymd' => 'required|date_format:Ymd',
            'enable_end_ymd' => 'required|date_format:Ymd',
            'information_naiyo' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $data = $request->only('information_title', 'information_kbn', 'keisai_ymd', 'enable_start_ymd', 'enaable_end_ymd', 'information_naiyo');

        $data['create_user_cd'] = 1;
        $data['create_time'] = Carbon::now();
        $data['update_user_cd'] = 1;
        $data['update_time'] = Carbon::now();

        $modelInformation = AsmsInformation::create($data);

        if($modelInformation)
            return response()->json(['success' => true, 'message' => 'お知らせの登録が成功しましいた。'], 201);
        return response()->json(['success' => false, 'message' => 'お知らせの登録が失敗しました。'], 500);
    }

    public function editInformation(Request $request){
        $validator = Validator::make($request->all(), [
            'information_id' => 'required|exists:asms_informations,id',
            'information_title' => 'required|string',
            'information_kbn' => 'required|boolean',
            'keisai_ymd' => 'required|date_format:Ymd',
            'enable_start_ymd' => 'required|date_format:Ymd',
            'enable_end_ymd' => 'required|date_format:Ymd',
            'information_naiyo' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $modelInformation = AsmsInformation::find($request->information_id);

        $data = $request->only('information_title', 'information_kbn', 'keisai_ymd', 'enable_start_ymd', 'enaable_end_ymd', 'information_naiyo');

        $data['update_user_cd'] = 1;
        $data['update_time'] = Carbon::now();

        if($modelInformation->update($data))
            return response()->json(['success' => true, 'message' => 'お知らせの変更が成功しましいた。']);
        return response()->json(['success' => false, 'message' => 'お知らせの変更が失敗しました。'], 500);
    }

    public function deleteInformation(Request $request){
        $validator = Validator::make($request->all(), [
            'information_id' => 'required|exists:asms_informations,id'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $modelInformation = AsmsInformation::find($request->information_id)->update(['delete_flg' => 1]);

        if($modelInformation)
            return response()->json(['success' => true, 'message' => 'お知らせの削除が成功しましいた。']);
        return response()->json(['success' => false, 'message' => 'お知らせの削除が失敗しました。'], 500);
    }
}
