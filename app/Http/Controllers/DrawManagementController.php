<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Draw;
use App\Models\DrawType;
use App\Models\Category;
use App\Models\GrandWinner;
use App\Models\Participant;

use Carbon\Carbon;

class DrawManagementController extends Controller
{
    public function startDraw(Request $request){
        $request->validate([
            'draw_type_id'=>'required|int'
        ]);

        $participantsCount = Participant::count();
        $categories = Category::all();

        $draw = Draw::create([
            'participants'=>$participantsCount,
            'no_of_winners'=>10,
            'schedule'=>Carbon::now(),
            'draw_type_id'=>$request->draw_type_id
        ]);

        return response()->json(['draw'=>$draw]);
    }

    public function discardAndCreate(Request $request){
        $request->validate([
            'draw_id'=>'required|integer'
        ]);

        $draw = Draw::find($request->draw_id);

        if($draw->status != 'started'){ //if draw is not in ongoing('started') status discard
            $draw->status = "discarded";
            $draw->save();

            $participantsCount = Participant::count();

            $draw = Draw::create([
                'participants'=>$participantsCount,
                'no_of_winners'=>5,
                'schedule'=>Carbon::today(),
                'draw_type_id'=>$draw->draw_type_id
            ]);
        }

        $drawType = DrawType::find($draw->draw_type_id);

        return response()->json(['message'=>'success','draw'=>$draw,'drawType'=>$drawType]);
    }

    public function completeDraw(Request $request,$draw){
        $activeDraw = Draw::find($draw);
        $activeDraw->status = "completed";
        $activeDraw->save();

        if($activeDraw->draw_type_id == 3){
            $grand_winner = GrandWinner::select('participant_id')->latest()->first();
            Participant::where('has_participated_grand_prize',false)->where('id', $grand_winner->participant_id)->update(['has_participated_grand_prize'=>true]);
        }

        return response()->json(['message'=>'success']);
    }
}
