<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\codegaming;
class CodegameController extends Controller
{
    public function getAllcodegame(){
        $codegamings = codegaming::get();
        $free110 = codegaming::get();
        $free231=codegaming::get();
        $free583 = codegaming::get();
        $pubge60 = codegaming::get();
        $pubge325 = codegaming::get();
        $robloxs = codegaming::get();
        $Razar5 = codegaming::get();
        $Razar10 = codegaming::get();
        $Razar20 = codegaming::get();
        $ituns5 = codegaming::get();
        $ituns10= codegaming::get();
        $ituns20= codegaming::get();
        $oropa200 = codegaming::get();
        $oropa315 = codegaming::get();
        $oropa795 = codegaming::get();
        return view('admin.codegame.show',compact('free110','free231','free583','pubge60','pubge325',
        'robloxs','Razar5','Razar10','Razar20','ituns5','ituns10','ituns20','oropa200','oropa315','oropa795'));
    }
    public function Addecodegame(){
        return view('admin.codegame.create');
    }
    public function newecodegame(Request $request){
        $free110 = codegaming::get();
        $free231=codegaming::get();
        $free583 = codegaming::get();
        $pubge60 = codegaming::get();
        $pubge325 = codegaming::get();
        $robloxs = codegaming::get();
        $Razar5 = codegaming::get();
        $Razar10 = codegaming::get();
        $Razar20 = codegaming::get();
        $ituns5 = codegaming::get();
        $ituns10= codegaming::get();
        $ituns20= codegaming::get();
        $oropa200 = codegaming::get();
        $oropa315 = codegaming::get();
        $oropa795 = codegaming::get();
        $codegamings = codegaming::get();
        $codegame=$request->input('code');
        $typegame=$request->input('type');
        if($typegame ==1 ){
            $free110=codegaming::create([
                'freefire110'=>$codegame,
            ]);
            
        }
        elseif($typegame ==2 ){

            $free231=codegaming::create([
                'freefire231'=>$codegame,
            ]);
        }
        elseif($typegame ==3){

            $free583=codegaming::create([
                'freefire583'=>$codegame,
            ]);
            
        }
        elseif($typegame ==4){

           $pubge60=codegaming::create([
                'pubge60'=>$codegame,
            ]);
        }
        elseif($typegame ==5){

            $pubge325=codegaming::create([
                'pubge325'=>$codegame,
            ]);
            
        }
        elseif($typegame ==6){

            $robloxs=codegaming::create([
                'Roblox10'=>$codegame,
            ]);
            
        }
        elseif($typegame ==7){

            $Razar5=codegaming::create([
                'Razar5'=>$codegame,
            ]);
            
        }
        elseif($typegame ==8){

            $Razar10=codegaming::create([
                'Razar10'=>$codegame,
            ]);
            
        }
        elseif($typegame ==9){

            $Razar20=codegaming::create([
                'Razar20'=>$codegame,
            ]);
        
        }
        elseif($typegame ==10){

            $ituns5=codegaming::create([
                'ituns5'=>$codegame,
            ]);
            
        }
        elseif($typegame ==11){

            $ituns10=codegaming::create([
                'ituns10'=>$codegame,
            ]);
           
        }
        elseif($typegame ==12){

            $ituns20=codegaming::create([
                'ituns20'=>$codegame,
            ]);
            
        }
        elseif($typegame ==13){

            $oropa200=codegaming::create([
                'oropa200'=>$codegame,
            ]);
            
        }
        elseif($typegame ==14){

            $oropa315=codegaming::create([
                'oropa315'=>$codegame,
            ]);
            
        }
        elseif($typegame ==15){

            $oropa795=codegaming::create([
                'oropa795'=>$codegame,
            ]);
           
        }
        return redirect('Code-game/code-games');
    //     return view('admin.codegame.show',compact('free110','free231','free583','pubge60','pubge325',
    // 'robloxs','Razar5','Razar10','Razar20','ituns5','ituns10','ituns20','oropa200','oropa315','oropa795'));
    }
}
