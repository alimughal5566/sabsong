<?php

namespace App\Http\Controllers;

use App\Models\Bet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Request;

class BetController extends Controller
{
    public function store(Request $request){
        $bet=Bet::create([
            "status"=>$request->status,
            "winner"=>$request->winner,
        ]);
        return response()->json(['bet'=>$bet],200);
    }

    public function updateBet(Request $request){

        $bet = Bet::find($request->id);
        $bet->fill([
         'status' =>$request->status,
         'winner' => $request->winner,
            ]);
        $bet->save();
        return response()->json(['bet'=>$bet],200);
    }
    public function getBet($id){
        $bet=Bet::where('id',$id)->first();
        return response()->json(['bet'=>$bet],200);
    }
public function deteleAllBets(){
    $bet=Bet::truncate();
    return response()->json(['bet'=>$bet],200);
}

    public function getall(){
        $bet=Bet::where('winner','!=',null)->get();

        return response()->json(['bet'=>$bet],200);
    }
    public function Show(){

        $Allbet=Bet::where('user_id',Auth::id())->get();
    }

}
