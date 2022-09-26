<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DrawWinner;
use App\Models\GrandWinner;
use App\Models\Participant;
use App\Models\Category;
use App\Models\Draw;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\WinnersExport;

class DrawWinnerController extends Controller
{
    public function exportWinners(Request $request,$draw){
        return Excel::download(new WinnersExport($draw), 'winners.xlsx');
    }

    public function disqualify(Request $request){
        $request->validate([
            'account_number'=>'required|string|max:20',
            'activeDraw'=>'required|int',
        ]);
        $participant = Participant::where('draw_id',$request->activeDraw)->where('phone_number',$request->account_number)->first();
            $participant->hasWon = 3;
            $participant->save();
            return response()->json(['message'=>'User disqualified']);
    }

    public function saveWinner(Request $request){
        $request->validate([
            'activeDraw'=>'required|int',
            'drawTypeId'=>'required|int',
            'account_number'=>'required|string',
            'winnerCategory'=>'required'
        ]);

        if($request->drawTypeId == 3){
            $participant = Participant::where('phone_number',$request->account_number)->first();
            $winner = GrandWinner::create([
                'participant_id'=>$participant->id,
                'status'=>1
            ]);
            $grandWinner = GrandWinner::with(['participant'])->where('id',$winner->id)->first();
            return response()->json(['message'=>'success','grandWinner'=>$grandWinner]);
        }

        DrawWinner::create([
            'draw_id'=>$request->activeDraw,
            'phone_number'=>$request->account_number,
            'category_id'=>$request->winnerCategory
        ]);


        if($request->drawTypeId == 3){
            $participant = Participant::where('phone_number',$request->account_number)->first();
        }else{
            $participant = Participant::where('draw_id',$request->activeDraw)->where('phone_number',$request->account_number)->first();
        }
        $participant->haswon = 1;
        $participant->save();

        return response()->json(['message'=>'success']);
    }

    public function grand_winner_disqualify(Request $request){
        $request->validate([
            'account_number'=>'required|string|max:20',
            'activeDraw'=>'required|int',
        ]);
        $participant = Participant::where('draw_id', 6)->where('phone_number', $request->account_number)->first();
        $participant->has_participated_grand_prize = 3;
        $participant->save();
        return response()->json(['message'=>'User disqualified']);
    }
}
