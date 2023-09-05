<?php

namespace App\Imports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\ToModel;

class ParticipantsImport implements ToModel
{
    private $draw;

    public function __construct($draw){
        $this->draw = $draw;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
	if($this->draw == 5){
	    return new Participant([
            'draw_id'=>$this->draw,
            'name'=>$row[0],
            'phone_number'=>$row[1],
          ]);
	}else{
	   return new Participant([
            'draw_id'=>$this->draw,
            'name'=>$row[0],
            'phone_number'=>$row[1],
           ]);
	}
        
    }
}
