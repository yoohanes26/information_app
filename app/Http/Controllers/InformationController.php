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
        $data = $request->only('information_title', 'information_kbn', 'keisai_ymd', 'enable_start_ymd', 'enable_end_ymd', 'information_naiyo');

        $data['keisai_ymd'] = str_replace('-', '', $data['keisai_ymd']);
        $data['enable_start_ymd'] = str_replace('-', '', $data['enable_start_ymd']);
        $data['enable_end_ymd'] = str_replace('-', '', $data['enable_end_ymd']);

        $validator = Validator::make($data, [
            'information_title' => 'required|string',
            'information_kbn' => 'required|boolean',
            'keisai_ymd' => 'required|date_format:Ymd',
            'enable_start_ymd' => 'required|date_format:Ymd',
            'enable_end_ymd' => 'required|date_format:Ymd',
            'information_naiyo' => 'required|string',
        ]);

        if($validator->fails()){
            return redirect()->back()->with('errorMessage', 'データが無効です。もう一度送信してください。');
        }

        $data['create_user_cd'] = 1;
        $data['create_time'] = Carbon::now();
        $data['update_user_cd'] = 1;
        $data['update_time'] = Carbon::now();

        $modelInformation = AsmsInformation::create($data);

        if($modelInformation)
            return redirect()->back()->with('successMessage', 'お知らせ新規登録が成功しました。');
        return redirect()->back()->with('errorMessage', 'データが無効です。もう一度送信してください。');
    }

    public function editInformation(Request $request){
        $data = $request->only('information_id', 'information_title', 'information_kbn', 'keisai_ymd', 'enable_start_ymd', 'enable_end_ymd', 'information_naiyo');

        $data['keisai_ymd'] = str_replace('-', '', $data['keisai_ymd']);
        $data['enable_start_ymd'] = str_replace('-', '', $data['enable_start_ymd']);
        $data['enable_end_ymd'] = str_replace('-', '', $data['enable_end_ymd']);

        $validator = Validator::make($data, [
            'information_id' => 'required|exists:asms_informations,information_id',
            'information_title' => 'required|string',
            'information_kbn' => 'required|boolean',
            'keisai_ymd' => 'required|date_format:Ymd',
            'enable_start_ymd' => 'required|date_format:Ymd',
            'enable_end_ymd' => 'required|date_format:Ymd',
            'information_naiyo' => 'required|string',
        ]);

        if($validator->fails()){
            return redirect()->back()->with('errorMessage', 'データが無効です。もう一度送信してください。');
        }

        $modelInformation = AsmsInformation::find($data['information_id']);

        $data['update_user_cd'] = 1;
        $data['update_time'] = Carbon::now();

        if($modelInformation->update($data))
            return redirect()->back()->with('successMessage', 'お知らせの変更が成功しましいた。');
        return redirect()->back()->with('errorMessage', 'データが無効です。もう一度送信してください。');
    }

    public function deleteInformation(Request $request){
        $validator = Validator::make($request->all(), [
            'information_id' => 'required|exists:asms_informations,information_id'
        ]);

        if($validator->fails()){
            return redirect()->back()->with('errorMessage', 'データが無効です。もう一度送信してください。');
        }

        $modelInformation = AsmsInformation::find($request->information_id)->update(['delete_flg' => 1]);

        if($modelInformation)
            return redirect()->back()->with('successMessage', 'お知らせの削除が成功しましいた。');
        return redirect()->back()->with('errorMessage', 'データが無効です。もう一度送信してください。');
    }
}
