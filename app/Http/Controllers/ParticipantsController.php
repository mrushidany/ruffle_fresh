<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use Schema;
use DB;
use Carbon\Carbon;

use App\Imports\ParticipantsImport;
use App\Models\Participant;

class ParticipantsController extends Controller
{
    public function index(Request $request){
        $count = Participant::count();
        return response()->json(['participants'=>$count]);
    }
    public function importParticipants(Request $request){
        if($request->ajax()){
            // Participant::truncate();
            $id = $request->drow_type_id;
                if($request->file){
                    $fileNameOne = time().'.'.$request->file->getClientOriginalExtension();
                    Excel::import(new ParticipantsImport($id), $request->file->move(public_path('temp'), $fileNameOne));
                }
                $count = Participant::where('draw_id',$request->draw)->orWhere('draw_id',$id)->count();
                $msg = '<div class="alert alert-success">Participants Uploaded Successfullty! Total: '.$count.' <a href="" class="btn btn-sm btn-success float-right">Refresh to run a draw</a></div>';

                return $msg;
        }

    }

    public function deleteData($draw_id){
        $participants = Participant::where('draw_id', '=', $draw_id)->get();
        if($participants){
            $clear = DB::table('participants')->where('draw_id', '=', $draw_id)->delete();
        }
        return back();
    }

}
