<?php
namespace App\Http\Controllers\Admin;

use App\Models\OfferBuyGet;
use App\Models\OfferDiscount;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Filters\OrderFilters;
use Illuminate\Support\Facades\Validator; 
use App\Http\Controllers\Api\BaseController;
use App\Models\Branch;
use App\Models\Order;
use App\Models\Item;
use App\Models\User;
use App\Models\Messages;
use App\Models\General;
use App\Models\Offer;
use App\Models\OrderItem;
use App\Models\Without;
use App\Models\PointsTransaction;
use App\Traits\GeneralTrait;
use App\Traits\LogfileTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends BaseController
{
    use GeneralTrait,LogfileTrait;

    public function index(Request $request)
    {
        $Messages = Messages::all();
        return view('admin.message.index',compact('Messages'));
    }
    public function create(Request $request)
    {
        return view('admin.message.create');
    }
    public function store(Request $request)
    {
        $validationRules = [
            'subject' => 'required|min:3|max:20',
            'description' => 'nullable',
            'push_notification' => 'nullable',
         ];
        $attributes = $request->validate($validationRules);

        $Messages = Messages::create([
            'subject' => $request->subject,
            'description' => $request->description,
            'push_notification' => $request->push_notification,
          ]);
          $this->Make_Log('App\Models\Messages','create',$Messages->id);
          if(isset($request->push_notification))
         {
             \App\Http\Controllers\NotificationController::pushAllNotification($request->description, $request->subject, null, null,null);
         } 
         $Messages = Messages::all();
        return redirect()->route('admin.notification.index')->with([
            'type' => 'success', 'message' => 'messages created successfuly',compact('Messages')
        ]);
    }
    public function destroy(Request $request, $id)
    {
        
        Messages::find($id)->delete();
        $this->Make_Log('App\Models\Messages','delete',$id);
        $Messages = Messages::all();
        return redirect()->back()->with([
            'type' => 'error', 'message' => 'notification deleted successfuly'
        ]);
    }
   
}