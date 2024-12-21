<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SendMoney extends Model
{
<<<<<<< HEAD
=======

>>>>>>> e0a16efd5bf1830ecea25b10a326989dcf90a9f6
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
<<<<<<< HEAD

    public function  receiver()
=======
 

  
    public function receiver()
>>>>>>> e0a16efd5bf1830ecea25b10a326989dcf90a9f6
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
