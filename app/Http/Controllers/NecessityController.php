<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Necessity;
use App\Models\GuestBooks;

class NecessityController extends Controller
{
    
    public function index() {
        
        return view('necesity.indexs');

    }

    public function getData(Request $request) {

        if($id) {
            
            $data = Necessity::where('id', $id)->first();

        } else {

            $data = Necessity::get();

            $no = 0;

            foreach ($data as $d) {
                $d->no = $no+=1;
            }

        }

        return $this->commitResponse('Success get data', true, $data);

    }

    public function createData(Request $request) {

        $data = new Necessity();
        $data->necessity = $request->necessity;
        $data->save();

        return $this->commitResponse('Success create data', true, $data);

    }

    public function updateData(Request $r) {

        $data = Necessity::where('id', $id)->first();
        
        $data->necessity = $request->necessity;
        $data->is_active = $request->is_active;
        $data->update();

        return $this->commitResponse('Success update data', true, $data);

    }

    public function deleteData() {

        $data = Necessity::where('id', $id)->first();

        $checkData = GuestBooks::where('necessity_id', $id)->first();
        if ($checkData) {
            return $this->commitResponse('This data can not delete');
        }

        $data->delete();

        return $this->commitResponse('Data has been deleted', true);

    }

}
