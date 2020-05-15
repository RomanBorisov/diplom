<?php

namespace App\Http\Controllers;

use Auth;
use Nexmo;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Document;
use App\User;
use App\SendCode;


class NexmoController extends Controller
{
    public function show()
    {
        return view('nexmo');
    }

    public function verify(Request $request)
    {
        $this->validate($request, [
            'code' => 'size:4'
        ]);
            
        $request_id = session('nexmo_request_id');
        $verification = new \Nexmo\Verify\Verification($request_id);

        Nexmo::verify()->check($verification, $request->code);

        $date = date_create();
        DB::table('users')->where('id', Auth::id())->update(['phone_verified_at' => $date]);

        return redirect('/documents')->with('success', 'Номер подтверждён!');
    }

    public function getDocVerify()
    {
        //$doc = Document::find(Auth::user()->id);
        return view('verifyDoc');
    }

    public function postDocVerify(Request $request)
    {
        if($doc = Document::where('code', $request->code)->first()){
            $doc->verified = 1;
            $doc->code = null;
            $doc->save();
            return redirect('/documents')->with('success', 'Документ подтверждён!');
        }
        else {
            return back()->with('error', 'Введённый код неверен. Пожалуйста, попробуйте заново');
        }
    }

}
