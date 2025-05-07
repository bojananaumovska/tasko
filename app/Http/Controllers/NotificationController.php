<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
   public function destroy($id)
   {
      $notification = Notification::find($id);
      $notification->delete();
      return redirect()->back();
   }
}
