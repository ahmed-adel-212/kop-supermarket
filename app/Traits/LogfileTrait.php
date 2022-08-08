<?php

namespace App\Traits;
use App\Models\LogFile;

trait LogfileTrait
{

public function Make_Log($model,$action,$action_id){
    return LogFile::create([
            'user_id'   =>  auth()->id(),
            'model'     =>  $model,
            'action'    =>  $action,
            'action_id' =>  $action_id,
    ]);
}

}
