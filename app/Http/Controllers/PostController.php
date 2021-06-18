<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Posts;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostFormRequest;
use Illuminate\support\facades\Auth;

class PostController extends Controller
{
    public  function __construct(){
        $this->middleware('auth');
        $this->user = Auth::user(Auth::getToken());
    }
    public function index()
    {
      return Posts::all();
    }

    public function store(Request $request)
    {
      //
      $data = [
          'author_id' => $this->user->id,
          'title' => $request->input('title'),
          'body' => $request->input('body'),
          'slug' => $request->input('slug')

      ];
    //   return $this->user->id;
        return Posts::create($data);
    }
    public function show($id)
    {
    $post = Posts::where('id',$id)->first();
    if(!$post)
    {
       return response()->json('requested page not found', 404);
    }
    // $comments = $post->comments;
    // return view('posts.show')->withPost($post)->withComments($comments);
    return response()->json($post, 200);
    }
    public function update(Request $request ,$id)
    {
    //
    
    $post = Posts::find($id);
     $post->update($request->all());
     return response()->json($post, 200);
  }
  public function destroy(Request $request, $id)
  {
    //
    $post = Posts::find($id);

    $post->delete();
    return response()->json('deleted successfuly', 200);
    


}
}