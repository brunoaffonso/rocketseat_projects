<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    /** @use HasFactory<\Database\Factories\LinkFactory> */
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Move link up or down. Receives 'up' or 'down' as parameter.
     *
     * @param string $action
     * @return void
     */
    public function move($action)
    {
        $user = $this->user;
        $currentOrderNum = $this->order_num;

        if ($action === 'up') {
            $newOrderNum = $currentOrderNum - 1;
        } else {
            $newOrderNum = $currentOrderNum + 1;
        }

        $swapLink = $user->links()->where('order_num', $newOrderNum)->first();
        $this->fill(['order_num' => $swapLink->order_num])->save();
        $swapLink->fill(['order_num' => $currentOrderNum])->save();
    }
}
