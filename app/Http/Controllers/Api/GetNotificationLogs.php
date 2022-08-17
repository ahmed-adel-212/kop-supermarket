<?php

namespace App\Http\Controllers\Api;

use App\Models\NotificationLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetNotificationLogs extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $logs = NotificationLog::where('user_id', auth()->id())->get();

        return $this->sendResponse($logs, 'notifications logs retrived successfully');
    }
}
