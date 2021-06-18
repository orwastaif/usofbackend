<?php 

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\support\facades\Auth;
use App\models\posts;
class CommentController extends Controller {

    public  function __construct(){
        $this->middleware('auth');
        $this->user = Auth::user(Auth::getToken());
    }
    public function index()
    {  comments::all();
   
       
  
       return comments::all();
}

  public function store(Request $request, $idpost)
  {

    $post = Posts::find($idpost);
    $data = [
        "from_user"=> $this -> user -> id,
        "on_post"=> $post -> id,
        "body" => $request -> input("body")
    ];

    Comments::create($data);
    return response()->json([
        'message'=>'Comment published',
        'data' => $data
    ],200);

    // return response()->json($idpost, 200);
   
  }
  public function update(Request $request ,$id)
    {
    //
    
    $comment = comments::find($id);
     $comment->update($request->all());
     return response()->json($comment, 200);
  }
  public function destroy(Request $request, $id)
  {
    //
    $comment = comments::find($id);

    $comment->delete();
    return response()->json('deleted successfuly', 200);
    


}
}
