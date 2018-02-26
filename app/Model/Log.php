<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model
{
    protected $table = 'log';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    use SoftDeletes;

    public static function log($message, $log_group = '', $order = '')
    {
        $log = new Log();
        $log->message = $message;
        $log->log_group = $log_group;
        $log->order = $order;
        $log->save();
        return $log;
    }

    public function getOrder()
    {
        return $this->belongsTo(Order::class, 'order', 'id');
    }
}
