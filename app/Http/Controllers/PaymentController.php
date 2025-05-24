<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\User;

class PaymentController extends Controller
{
    public function index($id){
        $task = Task::find($id);
        return view('tasks.payment', compact('task'));
    }
    public function store(Request $request, $id){
        DB::beginTransaction();
        try{
            $task = Task::find($id);
            $userPaying = User::find($request->payer_id);
            $userReceiving = User::find($request->receiver_id);

            if($userPaying->balance < $request->budget)
                throw new Exception('Insufficient balance. Pleace check your balance.');

            $userPaying->balance -= $request->budget;
            $userReceiving->balance += $request->budget;

            $userPaying->save();
            $userReceiving->save();

            $payment = Payment::create([
                'task_id' => $request->task_id,
                'payer_id' => $request->payer_id,
                'receiver_id' => $request->receiver_id,
                'amount' => $request->budget,
                'paid_at' => now(),
            ]);

            DB::commit();
            return redirect()->route('tasks.index')->with('success', 'Payment created successfully');

        }catch(Exception $e){
            DB::rollBack();
            return redirect()->route('tasks.index')->with('error', $e->getMessage());

        }
        
        
    }
}
