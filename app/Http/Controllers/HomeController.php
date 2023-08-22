<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Excel as BaseExcel;
use Maatwebsite\Excel\Facades\Excel;
use Schema;
use Session;
use App\Models\Participant;
use App\Models\Draw;
use App\Models\DrawWinner;
use App\Models\DrawType;
use App\Models\Category;
use Spipu\Html2Pdf\Html2Pdf;
use DB;
use Mail;
use App\Exports\WinnersExport;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $count = Participant::count();
        $draw = Draw::where('status','started')->first();
        $drawTypes = DrawType::all();

        return view('home')->withCount($count)->withActiveDraw($draw)->withDrawTypes($drawTypes);
    }

    public function draws(){
        return view('draws');
    }

    public function sendEmail(Request $request){
	if($request->ajax()){
	 $draw = $request->draw_id;
         $prize = $request->prize;
         $draw_category = $request->draw_category;
         $draw_name = $draw_category.'-'.$prize;
        $filename =  'RAFFLE_TOOL: '.$draw_name.'-Draw.csv';
        $filename2 = 'RAFFLE_TOOL'.$draw_name.'-Draw.pdf';

	$winners = DrawWinner::with(['category','draw','draw.drawType','participant'])->where('draw_id', '=', $draw)->orderBy('status', 'DESC')->get();
	$no_of_winners = Category::where('id', '=', $draw)->first();

	$html = '';
            $html = '
		<div style="width:100%; display:block;">
                <table style="width:100%; margin:0 auto;">
                    <tr>
                        <td colspan="3"><span style="bakground:red"><img src="http://raffle.befound.live/public/images/smartnology.png" height="140"></span></td>
                        <td colspan="7">
                            <div>PROMO NAME: RAFFLE CAMPAIGN</div>
                            <div>DRAW TYPE: '.$draw_name.'</div>
                            <div>DRAW PRIZE: '.$prize.'</div>
                            <div>NUMBER OF WINNERS: '.$no_of_winners->no_of_winners.'</div>
                            <div>BY: info@smartcodes.co.tz</div>
                        </td>
                    </tr>
                </table>';

                $html .= '<table border="1" border-style="collapse" width="100%" style="margin:0 auto;">
                        <thead style="background-color:#555;">
                            <tr>
                                <th>#</th>
                                <th>Participant</th>
                                <th>Code</th>
                                <th>Prize</th>';
				if($draw == 5){
                                 $html .= '<th>Deposited Amount</th>'.
                                  '<th>Amount Rewarded</th>';
                                }
                              	$html .= '<th>Status</th>
                            </tr>
                            </thead>
                            <tbody>';
                            $i = 1;
                            foreach($winners as $winner){
                                $html .= '<tr>'.
                                '<td>'.$i++.'</td>'.
                                '<td>'.$winner->name.'</td>'.
                                '<td>'.$winner->phone_number.'</td>'.
                                '<td>'.$prize.'</td>';
				if($draw == 5){
                                   $html .= '<td>'.number_format($winner->amount).'</td>'.
                                    '<td>'.number_format($winner->double_amount).'</td>';
                                }
                               $html .=  '<td>';
                                    if($winner->status == 1){
                                        $html .= 'Qualified';
                                    }else{
                                        $html .= '<span style="color:red;">Disqualified</span>';
                                    }
                                $html .= '</td>'.
                            '</tr>';
                            }
                            $html .= '</tbody></table></div>';
                            $html .= '<br><p>IN THE PRESENCE OF:</p>';
			    $html .= '<p>GAMING BOARD REPRESENTATIVE<br>';
			    $html .= 'NAME _____________________________ SIGN _______________ DATE _______________.</p>';
                            $html .= '<p>SMARTNOLOGY REPRESENTATIVE<br>';
                            $html .= 'NAME _____________________________ SIGN _______________ DATE _______________.</p>';


            //echo $html; die;

	    $filepath = public_path('/pdfs/'.time().'-'.$filename2);
            $html2pdf = new Html2Pdf('P', 'A4', 'en');
            $html2pdf->writeHTML($html);
	    $html2pdf->output($filepath, 'F');
	    $file2 = $filepath;


        $file =  Excel::raw(new WinnersExport($draw, $prize, $draw_category), BaseExcel::CSV);
         // $file = '';
	 $email = 'hawa@smartnology.co.tz';
	 $name = 'Hawa Mwakatundu';
	 //$email = 'david@smartcodes.co.tz'; 
	 //$name = 'David Lyimo';
         $subject = 'RAFFLE TOOL | - '.$prize.' Winners';

         Mail::send(['html'=>'emails.reports'], ['prize' => $prize, 'draw_category' => $draw_category, 'draw_name' => $draw_name], function($mail) use($email, $name, $subject, $file, $file2, $filename, $filename2){
             $mail->from('info@smartnology.co.tz', 'RAFFLE Draw');
             $mail->subject($subject);
             $mail->to($email, $name);
	     $mail->cc('daniel@smartnology.co.tz', 'Daniel Mrushi');
	     $mail->attachData($file, $filename);
	     $mail->attach($file2);
         });
	 $sms = 'Email sent successfully';
	 return $sms;
       }
    }

    public function drawMC($period, $type){ 
        if($period == 'weekly'){
            $main_title = '<h3>Weekly Draw!</h3>';
            if($type == 'mc_draw'){
                $title = 'First Draw Winner';
                $draw_id = 1;
            }elseif($type == 'cp_draw'){
                $title = 'Cash Prize';
                $draw_id = 2;
            }
            $checkDrow = Participant::where('draw_id', '=', $draw_id)->get();
            if(count($checkDrow) > 0){
                $msg = '<div class="alert alert-info">Participants Uploaded Successfullty! Total: '.count($checkDrow).'</div>';
            }else{ $msg = null; }

        }elseif($period == 'monthly')  {
            $main_title = '<h3>Montly Draw!</h3>';
            if($type == 'mc_draw'){
                $title = 'Motorcycle';
                $draw_id = 3;
            }elseif($type == 'cp_draw'){
                $title = 'Cash Prize';
                $draw_id = 4;
            }elseif($type == 'ds_draw'){
                $title = 'Double Saving';
                $draw_id = 5;
            }
            
        }elseif($period == 'gp_draw'){
            $main_title = '<h3>Grand Prize Draw!</h3>';
            $title = 'Grand Prize';
            $draw_id = 6;
        }else{
            return redirect('draws');
        }

        $checkDrow = Participant::where('draw_id', '=', $draw_id)->get();
        $checkWinners = DrawWinner::where('draw_id', '=', $draw_id)->where('status', '=', 1)->get();
        
	$totalWinners = Category::where('id', '=', $draw_id)->first();

        if(count($checkWinners) > 0){
            $draw_winners = $checkWinners;
            $count = $totalWinners->no_of_winners - count($checkWinners);
        }else{   
            $draw_winners = null; 
            $count = $totalWinners->no_of_winners;
        }

        if(count($checkDrow) > 0){
            $msg = '<div class="alert alert-success">Total Participants: '.count($checkDrow).' <a href="'.url('delete_data/'.$draw_id).'" class="btn btn-sm btn-danger float-right" disabled><i class="fa-solid fa-trash"></i> Clear Data</a></div>';
        }else{ $msg = null; }
        
	$winners = Session::get('draw', null);
        if($winners == null){
            $winners = DB::table('participants')->where('draw_id',$draw_id)->where('hasWon',0)->select(['id','phone_number'])->inRandomOrder()->take($count)->get()->toArray(); 
            Session::put('draw', ['winners' =>$winners, 'draw_id' => $draw_id]);
            $winners = Session::get('draw', null);
        }

        return view('upload')
        ->with('msg', $msg)
        ->with('main_title', $main_title)
        ->with('title', $title)
        ->with('period', $period)
        ->with('draw_id', $draw_id)
        ->with('winners', $winners)
	->with('count', $count)
        ->with('draw_winners', $draw_winners);
  
    }

  

}
