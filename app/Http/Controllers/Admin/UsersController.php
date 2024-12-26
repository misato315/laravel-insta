<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class UsersController extends Controller
{
    private $user;

    public function __construct(User $user_model){
        $this->user = $user_model;
    }

    // public function index(){
    //     $all_users = $this->user->withTrashed()->latest()->paginate(4);

    //     return view('admin.users.index')->with('all_users',$all_users);
    // }

    public function index(Request $request){
        // 検索クエリを受け取る
        $search = $request->input('search', ''); //フォームで送信された searchパラメータ（検索キーワード）を取得
        // 検索パラメータが送信されていない場合、$search には空文字 ''が設定される。よって検索がない場合でもエラーを回避し、後続の処理を安全に実行できる
    
        // クエリが空でない（検索キーワードが入力されている）場合に検索条件を適用
        $all_users = User::withTrashed() //withTrashed()を使うことで、削除された（非アクティブな）ユーザーも結果に含まれる
        ->when($search, function($query, $search) { //User::when()は、$searchが存在する場合に、指定した検索条件を適用するためのメソッド
            return $query->where('name', 'like', '%' . $search . '%');//ユーザーの名前(name フィールド)が検索キーワード ($search)を含んでいる場合にマッチ
        })->paginate(6) // ページネーションで1ページに表示するユーザー数を設定
            ->withQueryString();
    
        // ビューにデータを渡す
        return view('admin.users.index', compact('all_users'));
    }
    

    public function deactivate($id){
        $this->user->destroy($id);

        return redirect()->back();
    }

    public function activate($id){
        $this->user->onlyTrashed()->findOrFail($id)->restore();

        return redirect()->back();
    }
   
    
}
