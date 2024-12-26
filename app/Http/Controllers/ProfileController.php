<?php

#USERモデルをインポート、プライベートプロパティ,construct
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;//忘れない！！
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class ProfileController extends Controller
{
    private $user;

    public function __construct(User $user_model){
        $this->user = $user_model;

    }

    public function show($id, Request $request){

        $user = $this->user->findOrFail($id);

        // クエリパラメータでタブを決める
        $tab = $request->query('tab', 'posts');  // デフォルトで 'posts' タブを表示

        // ユーザーが投稿したポスト
        $posts = $user->posts;

        // ユーザーがブックマークしたポスト
        $bookmarkedPosts = $user->bookmarkedPosts;

        // ユーザーがいいねしたポスト
        $likedPosts = $user->likedPosts;

        return view('users.profile.show', compact('user', 'posts', 'bookmarkedPosts','likedPosts', 'tab'));
    }

    public function edit(){
        $user = $this->user->findOrFail(Auth::user()->id);

        return view('users.profile.edit')->with('user',$user);
    }
    
    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required|min:1|max:50',
            'email'=> 'required|email|max:50|unique:users,email,'. Auth::user()->id,
            'avatar'=> 'mimes:jpeg,jpg,png,gif|max:1048',
            'introduction'=>'max:100'
        ]);

        $user = $this->user->findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->introduction = $request->introduction;

        if($request->avatar){
        $user->avatar = 'data:avatar/'.$request->avatar->extension().';base64,'.base64_encode(file_get_contents($request->avatar));
        }

        $user->save();

        return redirect()->route('profile.show',$id); 
    }

    // パスワード変更
    public function passwordUpdate(Request $request,$id){
        $request->validate([
            'password' => 'required|current_password', //現在のパスワードを確認
            'password_new' => 'required|string|min:8|confirmed'//新しいパスワード（8文字以上、確認が一致すること）
        ]);

        $user = $this->user->findOrFail($id);

        $user->password = Hash::make($request->password_new);//新しいパスワードをハッシュ化して保存
        $user->save();

        return redirect()->route('profile.show',$id)->with('status', 'Password updated successfully!'); 
    }

    public function followers($id){
        $user = $this->user->findOrFail($id);

        return view('users.profile.followers')->with('user',$user);
    }

    public function following($id){
        $user = $this->user->findOrFail($id);

        return view('users.profile.following')->with('user',$user);
    }
}
