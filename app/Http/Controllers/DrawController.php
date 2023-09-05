<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Draw;
use App\Models\DrawType;
use App\Models\DrawWinner;
use App\Models\Participant;
use App\Models\Category;
use App\Models\GrandWinner;
use Carbon\Carbon;
use Session;
use Redirect;
use Illuminate\Support\Facades\DB;

class DrawController extends Controller
{

    private $next_category;

    public function getDraws(Request $request){
        $activeDraw = Draw::with(['drawWinners','drawWinners.category','drawWinners.participant'])->where('status','!=','discarded')->whereDate('created_at',Carbon::today())->get();
        $drawTypes = DrawType::all();

        return response()->json(['activeDraws'=>$activeDraw,'drawTypes'=>$drawTypes]);
    }

    public function getCurrentDrawWinners(Request $request){
        $activeDraw = Draw::where('status','started')->where('status','!=','discarded')->whereDate('created_at',Carbon::today())->first();

        if(!$activeDraw){
            return response()->json(['message'=>"No running draw"],404);
        }

        $winners = DrawWinner::with(['category','draw.drawType','participant'])->where('draw_id',$activeDraw->id)->get();
        $categories = Category::where('draw_type_id',$activeDraw->draw_type_id)->get();

        $currentDrawWinners = DrawWinner::where('draw_id',$activeDraw->id)->select(['category_id'])->get();
        $c = array();
        foreach ($currentDrawWinners as $key => $id) {
            array_push($c,$currentDrawWinners[$key]['category_id']);
        }

        $totalWinners = Category::where('draw_type_id',$activeDraw->draw_type_id)->select('no_of_winners')->sum('no_of_winners');

        return response()->json(['winners'=>$winners,'categories'=>$categories,
            'completedCategories'=>$c,'totalWinners'=>$totalWinners]);
    }


    public function spin_draw(Request $request){
        if($request->ajax()){
            $request->validate([
                'draw_id'=>'required|int',
                //'sub_draw_type'=>'required|int'
            ]);

            if($request->period == 'weekly'){
                $draw_type_id = 1;
            }
            elseif($request->period == 'monthly'){
                $draw_type_id = 2;
            }
            else{
                $draw_type_id = 3;
            }

            if($request->draw_type_id == 3){
                $participant = $this->grandWinner();
                //return response()->json(['phone_number'=>$participant->phone_number,'winner_name'=>$participant->name,'category'=>"grand"]);
                Session::put('winner', $participant);
                $msg = $participant;
            }

            $category = Category::where('id', $request->draw_id)->select('no_of_winners')->first();
            $no_off_winners = $category->no_of_winners;
            $winners = DB::table('participants')->where('draw_id',$request->draw_id)->where('hasWon',0)->select(['id','phone_number'])->inRandomOrder()->take($request->count)->get()->toArray();
            if(count($winners) < 1){
                //return response()->json(['message'=>"You have ran out of participants"],201);
                $msg = 0;
                $msg1 = "We couldn't find a winner, You have ran out of participants";
            }else{
                Session::forget('draw', null);
                Session::put('draw', ['winners' =>$winners, 'draw_id' => $request->draw_id]);
                $winners = Session::get('draw', null);
                $msg = $winners['winners'];
                //dd($winners['winners']);
            }
            return $msg;
        }
    }

    public function saveDraw(Request $request){
        if($request->ajax()){
            $winners = Session::get('draw', null);
            $draw_id = $winners['draw_id'];
            foreach($winners['winners'] as $winner){
                $participant = Participant::where('phone_number', '=', $winner->phone_number)->where('draw_id', '=', $draw_id)->first();
                //dd($participant);
                if($participant){
                    $participant->haswon = 1;
                    $participant->save();

                    $draw = new DrawWinner;
                    $draw->draw_id = $draw_id;
                    $draw->category_id = $draw_id;
                    $draw->name = $participant->name;
                    $draw->phone_number= $participant->phone_number;
		            // if($draw_id == 5){
                    //     $draw->amount = $participant->amount;
                    //     if($participant->amount >= 200000){
                    //         $draw->double_amount = 200000;
                    //     }else{
                    //         $draw->double_amount = $participant->amount;
                    //     }
                    // }
                    $draw->status = 1;
                    $draw->save();
                }
            }
            Session::forget('draw', null);
            $msg = '<div class="alert alert-success">Winners saved successfully</div>';
            return $msg;
        }
    }


    public function discardResult(Request $request, $draw_id){
        $participants = Participant::where('draw_id', '=', $draw_id)->where('haswon', '=', 1)->get();
        if($participants){
            foreach($participants as $participant){
                $participant->haswon = 0;
                $participant->save();
            }
            $clear = DB::table('draw_winners')->where('draw_id', '=', $draw_id)->delete();
        }
        return Redirect::back();
    }


    public function disqualifyWinner(Request $request, $winner_id){
        $participant = DrawWinner::where('id', '=', $winner_id)->where('status', '=', 1)->first();
        if($participant){
            $participant->status = 0;
            $participant->save();
        }
        return Redirect::back();
    }

    public function spin(Request $request){
        $request->validate([
            'draw_type_id'=>'required|int',
            'draw_id'=>'required|int',
            //'sub_draw_type'=>'required|int'
        ]);

        if($request->draw_type_id == 3){
            $participant = $this->grandWinner();
            return response()->json(['phone_number'=>$participant->phone_number,'winner_name'=>$participant->name,'category'=>"grand"]);
        }

        if($request->sub_draw_type != null){
            $category = Category::where('id', $request->sub_draw_type)->select('no_of_winners')->first();
            $no_off_winners = $category->no_of_winners;
            $participants = DB::table('participants')->where('draw_id',$request->draw_id)->where('hasWon',0)->select(['name','phone_number'])->inRandomOrder()->take($no_off_winners)->get()->toArray();

            if(count($participants) < 1){
                return response()->json(['message'=>"You have ran out of participants"],201);
            }

            foreach($participants as $participant){
                DrawWinner::create([
                    'draw_id' => $request->draw_id,
                    'category_id' => $request->draw_type_id,
                    'phone_number' => $participant->phone_number,
                    'status' => 'new'
                ]);
            }
            return response()->json(['winners' => $participants]);
        }
    }

    private function isCategoryWinnerCountFull($winners,$draw){
        $last = $winners->last();
        if($last == null){
            return true;
        }
        $category = Category::find($last->category_id);

        if(!$category){
            return true;
        }
        $winnersCount = DrawWinner::where('draw_id',$draw)->where('category_id',$category->id)->count();

        if($winnersCount < $category->no_of_winners){
            $this->next_category = $category;
            // dd($this->next_category);
            return false;
        }
        return true;
    }

    private function grandWinner(){
        $participants = Participant::where('draw_id', 6)->where('has_participated_grand_prize',false)->get();
        $participantsCount = $participants->count();
        $randomIndex = random_int(0,$participantsCount-1);

        $grandWinner = $participants[$randomIndex];

        return $grandWinner;
    }

}
