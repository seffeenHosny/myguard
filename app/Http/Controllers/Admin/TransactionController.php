<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(){
        $data = Transaction::orderBy('id' , 'DESC')->get();
        return view('admin.transactions.index' , compact('data'));
    }
}
