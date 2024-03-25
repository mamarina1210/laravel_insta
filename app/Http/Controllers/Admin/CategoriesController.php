<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class CategoriesController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        #withTrashed = all 
        $all_categories = $this->category->orderBy('updated_at', 'desc')->paginate(10);
        $uncategorized_count = 0;
        $all_posts = $this->post->all();
        foreach($all_posts as $post){

            if($post->categoryPost->count()==0){
                $uncategorized_count++;
            }

        }

        return view('admin.categories.index')->with('all_categories', $all_categories)
        ->with('uncategorized_count', $uncategorized_count);
    }
    public function delete($id)

    {
        $this->category->destroy($id);
        return redirect()->back();
    }


    public function store(Request $request)
    #newdata
    {

        $request->validate([

            'name'  => 'required|min:1|max:50|unique:categories,name'
        ]);

        
        $this->category->name = ucwords(strtolower($request->name)); //CoOking !=cooking
        $this->category->save();

        return redirect()->back();
    }

    #edit
    #update take change 

    #edit => moving to different 
    public function update(Request $request, $id)
    {
        
        $request->validate([
            'name'  => 'required|min:1|max:50|unique:categories,name'
        
        ]);
        #value that already exists
        // $this->category 
        $category = $this->category->findOrFail($id);
        $category->name = ucwords(strtolower($request->name)); //CoOking !=cooking
        $category->save();
        
        return redirect()->back();
}
}