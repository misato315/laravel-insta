<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CategoryPost;
use App\Models\Category;
use App\Models\Post;

class CategoriesPost extends Controller
{
    private $category;

    // public function __construct(CategoryPost $categorypost_model){
    //     $this->categorypost = $categorypost_model;
    // }

    // public function index(){
    //     $all_categories = $this->categorypost->get();

    //     return view('admin.categories.index')->with('all_categories',$all_categories);
    // }

    public function __construct(Category $category_model){
        $this->category = $category_model;
    }

    public function index(){
        $all_categories = Category::orderBy('updated_at','desc')->get();

        // カテゴリー毎の選択された数を取得
        // $categoryCount = CategoryPost::count();
        $categoryCounts = [];
        foreach ($all_categories as $category) {
            $categoryCounts[$category->id] = CategoryPost::where('category_id', $category->id)->count();
        }

        // Uncategorized 投稿数を取得
        $uncategorizedCount = Post::whereDoesntHave('categoryPost')->count();

        return view('admin.categories.index',compact('all_categories','categoryCounts','uncategorizedCount'));
    }
    
    public function update(Request $request,$id){
        $request->validate([
            'name'=>'required|max:50'
        ]);
        $category = $this->category->findOrFail($id);
        $category->name = $request->name;
  

        $category->save();
        return redirect()->route('admin.categories');
    }

    public function destroy($id){
        $this->category->destroy($id);
        return redirect()->back();
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|max:50'
        ]);
        $this->category->name = $request->name;
        $this->category->save();

        return redirect()->route('admin.categories');
    }
}
