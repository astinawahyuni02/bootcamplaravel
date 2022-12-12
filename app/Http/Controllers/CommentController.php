<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\News;

class CommentController extends Controller
{
    public function index()
    {
        $news = News::get();

        return view('comment.index', compact('news'));
    }

    public function getData(Request $request)
    {

        if ($request->id) {
            $data = Comment::where('id', $request->id)->first();
        }else {
            $no = 0;
            $data = Comment::with('news')->get();

            foreach ($data as $d ) {
                $d->no = $no+=1;
            }
        }

        $result['data'] = $data;

        return response()->json($result);
    }

    
    // public function createData(Request $request)
    // {
    //     $check = Comment::where('name',$request->name)->first();
        
    //     if ($check) {
    //         return $this->result("Name is already exist");

    //     }else{

    //         $data = new Comment();
    //         $data->name =$request->name;
    //         $data->title =$request->title;
    //         $data->comment =$request->comment;
    //         $data->is_active =$request->is_active;
    //         $data->save();

    //         return $this->result("Success create data", true, $data);
    
    //     }

    // }

    public function createData(Request $request)
    {
        $result = [
            'status'=> false,
            'data'=> null,
            'message'=> '',
            'newToken'=> csrf_token()
        ];

        $check = Comment::where('name',$request->name)->first();
        if ($check) {
            $result['message'] = "Comment name is already exist";
            return response()->json($result);
        }

        $data = new Comment();
        $data->name =$request->name;
        $data->title =$request->title;
        $data->comment =$request->comment;
        $data->is_active =$request->is_active;
        $data->save();

        $result['newToken'] = csrf_token();
        $result['status'] = true;
        $result['data'] = $data;
        $result['message'] = "Success create data";

        // bisa juga untuk result yg ini, terserah mau yg mana :
        // $result =[
        //     'status'=> true,
        //     'data'=> $data,
        //     'message' => "Success create data"
        // ];

        return response()->json($result);
    }
    
    public function updateData(Request $request, $id)
    {
        
        $check = Comment::where('name', $request->name)->where('id', '!=', $id)->first();
        if ($check) {
            $result['message'] = 'Comment name already exist';
            return response()->json($result);
        }

        $data = Comment::where('id', $id)->first();

        //untuk tanda kalo database nya udh tidak ada, tinggal reload aja.
        if(!$data){
            $result['message'] = "Category not found";
            return response()->json($result);
        }

        $data->name =$request->name;
        $data->phone_number =$request->phone_number;
        $data->comment =$request->comment;
        $data->is_active =$request->is_active;
        $data->save();

        $result['status'] = true;
        $result['data'] = $data;
        $result['message'] = "Update Category Successfuly";

        return response()->json($result);
    }

    public function deleteData($id)
    {

        $data = Comment::where('id', $id)->first();

        if (!$data) {
            return $this->result("Comment not found");
        }else{

            $data->delete();
            return $this->result("Comment has been deleted");
        }
    }
}
