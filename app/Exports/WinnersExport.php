<?php

namespace App\Exports;

use App\Models\DrawWinner;
use App\Models\Participant;
use App\Models\Category;
use App\Models\Draw;
use App\Models\GrandWinner;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class WinnersExport implements FromCollection, WithHeadings
{
    private $draw;

    public function  __construct($draw, $draw_category, $prize){
        $this->draw = $draw;
	$this->draw_category = $draw_category;
	$this->prize = $prize;
    }

    public function headings(): array
    {
        if($this->draw == 5){
		return ["S/N", "Name", "Phone Number","Prize", "Deposeted Amount", "Amount Rewarded", "Draw Category", "Status"];
	}else{
		return ["S/N", "Name", "Phone Number","Prize","Draw Category", "Status"];
	}
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $trimmed = collect([]);
        $counter = 0;

	//echo $this->draw_category; exit;

        if($this->draw == 3){
            $grand_participant = GrandWinner::where('status', 1)->select('participant_id')->latest()->first();
            $grand_winner = Participant::where(['id' => $grand_participant->participant_id, 'has_participated_grand_prize' => false])->first();
            $obj = (object)array();
            $obj->id = 1;
            $obj->name = $grand_winner->name;
            $obj->phone = $grand_winner->phone_number;
            $obj->category = 'Grand Prize';
            $obj->draw = 'Grand Prize';
            $trimmed->push($obj);
            return $trimmed;
        }

        $winners = DrawWinner::with(['category','draw','draw.drawType'])->where('draw_id',$this->draw)->get();

        $winners->each(function($item,$key)use($trimmed){
            $obj = (object)array();
            $counter = count($trimmed)+1;
            $obj->id = $counter;
            $obj->name = $item->name;
            $obj->phone = $item->phone_number;
            $obj->draw = $this->prize;
	    if($this->draw == 5){
		$obj->amount = $item->amount;
		if($item->amount >= 200000){
		  $obj->double_amount = number_format(200000);
		}else{
		  $obj->double_amount = number_format($item->amount);
		}
	    }
	    $obj->category = $this->draw_category;
	    if($item->status == 1){
                $obj->status = 'Qualified';
            }else{
                $obj->status = 'Disqualified';
            }
            $trimmed->push($obj);
        });

        return $trimmed;
    }
}
