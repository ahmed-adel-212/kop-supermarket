<?php
namespace App\Http\Controllers\Api;

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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends BaseController
{
    use GeneralTrait;
    public function index(Request $request)
    {
        $Messages = Messages::all();
        return view('admin.messages.index',compact('Messages'));
    }
    public function create(Request $request)
    {
        return view('admin.messages.create');
    }
    public function store(Request $request)
    {
        $validationRules = [
            'subject' => 'required|min:3|max:20',
            'description' => 'nullable',
            'push_notification' => 'required',
         ];
        $attributes = $request->validate($validationRules);

        $Messages = Messages::create([
            'subject' => $request->subject,
            'description' => $request->description,
            'push_notification' => $request->push_notification,
          ]);
          $this->Make_Log('App\Models\Messages','create',$Messages->id);
          if($request->push_notification==1)
         {
            \App\Http\Controllers\NotificationController::pushNotifications($request->description, $request->subject, null, null,null);
         } 
          return redirect()->route('admin.messages.index')->with([
            'type' => 'success', 'message' => 'messages created successfuly'
        ]);
    }
    public function destroy(Request $request, Messages $message)
    {
        Messages::find($id)->delete();
        $this->Make_Log('App\Models\Messages','delete',$id);
        return redirect()->route('admin.messages.index')->with([
            'type' => 'success', 'message' => 'messages deleted successfuly'
        ]);
    }
   
}