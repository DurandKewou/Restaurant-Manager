<?php

namespace App\Http\Controllers\Admin;

use App\Models\ReservationConfirmed;
use App\Models\Reservation;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;

class ReservationController extends Controller
{
    public function index(){
        $reservations = Reservation::all();
        return view('admin.reservation.index',compact('reservations'));
    }

    public function store(Request $request){

        $this->validate($request,[
           'name'=>'required',
           'phone'=>'required',
           'email'=>'required|email',
           'dateandtime'=>'required'
        ]);
        $reservation = new Reservation();
        $reservation->name=$request->name;
        $reservation->phone=$request->phone;
        $reservation->email=$request->email;
        $reservation->date_and_time=$request->dateandtime;
        $reservation->message=$request->message;
        $reservation->status=false;
        $reservation->save();

        return redirect()->back()->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);

    }

    public  function status($id){

        $reservation = Reservation::find($id);
        $reservation->status=true;
        $reservation->save();
        Notification::route('mail', $reservation->email)->notify(new ReservationConfirmed());

        return redirect()->back();

    }

    public function destory($id){
        Reservation::find($id)->delete();
        Toastr::success('Reservation successfully deleted','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();

    }


}
