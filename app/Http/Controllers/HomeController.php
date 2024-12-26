<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\User;
use App\Models\Like;

use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{

    private $post;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Post $post_model,User $user_model)
    {
        $this->post = $post_model;
        $this->user = $user_model;
        $this->middleware('auth');
    }

    #Get the posts of the users that the Auth user is following
    public function getHomePosts(){
        $all_posts = $this->post->latest()->get();
        $home_posts = []; //if case the $home_posts at Line 35 is empty, it will not return NULL, but epmty array instead

        foreach ($all_posts as $post) {
            if($post->user->isFollowed() || $post->user->id === Auth::user()->id){
                $home_posts[] = $post;
            }
        }
        return $home_posts;
    }

    //提案ユーザーの人数を制限して返す
    public function getSuggestedUsers($limit = null){
        $all_users = $this->user->all()->except(Auth::user()->id);
        $suggested_user = [];

        foreach($all_users as $user){
            if(!$user->isFollowed()){
                $suggested_user[]= $user;
            }
        }

        // 引数に渡された$limitがあれば、その数だけ返す
        if ($limit) {
        return array_slice($suggested_user, 0, $limit);
        }

        return $suggested_user;
    }

    //提案される全てのユーザーを表示
    public function showAllSuggestedUsers(){
        $suggested_users = $this->getSuggestedUsers(); // 制限なしで全てのユーザーを取得
    
        return view('users.suggesteduser')
            ->with('suggested_users', $suggested_users);
    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     $all_posts = $this->getHomePosts();
    //     $suggested_users = $this->getSuggestedUsers(4);

    //     return view('users.home')
    //             ->with('all_posts',$all_posts)
    //             ->with('suggested_users',$suggested_users);
    // }
    
    public function index() {

        // 提案ユーザーを全て取得
        $suggested_users = collect($this->getSuggestedUsers()); // 状態がアクティブなユーザーに絞る
            // ランダムに並び替え（必要なら）
                                
    
        // 提案ユーザーが5人以上なら4人に制限
        $limited_suggested_users = $suggested_users->take(4);
    
        $all_posts = $this->getHomePosts();
    
        return view('users.home', compact('all_posts', 'suggested_users', 'limited_suggested_users'));
    }

    public function search(Request $request){
        // ユーザー表のnameカラムに対して部分一致検索を行う
        $users = $this->user->where('name','like','%'. $request->search. '%')->get();
        
        return view('users.search')
                ->with('users',$users)
                ->with('search',$request->search);
    }

    //いいねしたユーザーの名前を検索すると途中
    public function likesearch(Request $request){
        // ユーザー表のnameカラムに対して部分一致検索を行う
        $users = $this->user->where('name','like','%'. $request->search. '%')->get();
        
        return view('users.search')
                ->with('users',$users)
                ->with('search',$request->search);
    }

    public function searchUser(Request $request){
        // ユーザー表のnameカラムに対して部分一致検索を行う
        $users = $this->user->where('name','like','%'. $request->search. '%')->get();
        
        return view('admin.users.index')
                ->with('users',$users)
                ->with('search',$request->search);
    }
        

}
