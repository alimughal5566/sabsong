<?php

namespace App\Http\Controllers;

use App\Models\PlaceBet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaceBetController extends Controller
{
    public function storePlaceBet(Request $request){
        $PlaceBet=PlaceBet::create([
            "coins"=>$request->coins,
            "player"=>$request->player,
            "betOdds"=>$request->betOdds,
            "anyOddsCheck"=>$request->anyOddsCheck,
            "bet_id"=>$request->bet_id,
            "user_id"=>Auth::id(),

        ]);
        return response()->json(['PlaceBet'=>$PlaceBet],200);
    }
}
