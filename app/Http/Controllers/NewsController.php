<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;
use Redirect;

class NewsController extends Controller
{
    public function index()
    {
        $category = Category::get();
        return view('news.index', compact('category'));

    }

    public function getData(Request $request)
    {

        if ($request->id) {
            $data = News::where('id', $request->id)->first();
        }else {
            $no = 0;
            $data = News::with('category')->get();

            foreach ($data as $d ) {
                $d->no = $no+=1;
                $d->created_date = date_format($d->created_at, "d F Y h:i");
            }
        }

        $result['data'] = $data;

        return response()->json($result);
    }

    public function createData(Request $request)
    {
        $check = News::where('title',$request->title)->first();
        
        if ($check) {
            return $this->result("Title name is already exist");

        }else{

            $data = new News;
            $data->id_category =$request->id_category;
            $data->title =$request->title;
            $data->description =$request->description;

            $data->save();

            return $this->result("Success create data", true, $data);
    
        }

    }

    public function updateData(Request $request, $id)
    {
        $check = News::where('title', $request->title)->where('id', '!=', $id)->first();
        if ($check) {

            return $this->result('Title already exist');
        }

        $data = News::where('id', $id)->first();

        //untuk tanda kalo database nya udh tidak ada, tinggal reload aja.
        if(!$data){

            return $this->result('Category not found');

        }else{
        
        $data = News::where('id', $id)->first();

        $data->title = $request->title;
        $data->id_category = $request->id_category;
        $user->description = $request->description;
        $user->update();

        // return $this->result('Update Category Successfuly',true $data);
        return $this->result("Success update data", true, $data);

        }

        
    }

    // untuk mengembalikan data 
    public function restoreData()
    {
        $restore = News::where('id', '10')->onlyTrashed()->restore();
        if ($restore) {
            $result = [
                'message' => 'Success restore data',
                'data' => $restore
            ];
            return response()->json($result);
        }
    }

    public function deletePermanentData(){
        $delete = News::where('id', '11')->forceDelete();
        if($delete){
            $result=[
                'message' => 'Success delete permanent data',
                'data' => $delete
            ];
            return response()->json($result);
        }
    }

    public function deleteData($id)
    {

        $data = News::where('id', $id)->first();

        if (!$data) {
            return $this->result("Category not found");
        }else{

            $data->delete();
            return $this->result("Category has been deleted");
        }
    }

}
