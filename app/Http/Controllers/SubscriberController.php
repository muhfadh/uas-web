<?php

namespace App\Http\Controllers;

use App\Subscriber;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request){
        $customMessages = [
            'required' => ':attribute tidak boleh kosong!',
            'unique' => ':attribute sudah terdaftar!'

        ];
        $this->validate($request,[
            'email' => 'required|email|unique:subscribers'
        ], $customMessages);

        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->save();
        Toastr::info('Selamat kamu berhasil menjadi subscriber kami!', 'Sukses');

        return redirect()->back();

    }
}
