<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Review;
use App\Models\Transaction;

class User extends Authenticatable
{
    protected $guarded = [];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected function casts(): array {
        return [
            'password' => 'hashed',
        ];
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'from_user_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'to_user_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id');
    }

    public function reviewsWritten()
    {
        return $this->hasMany(Review::class, 'reviewer_id');
    }

    public function reviewsReceived()
    {
        return $this->hasMany(Review::class, 'reviewed_user_id');
    }

    public function sentTransactions()
    {
        return $this->hasMany(Transaction::class, 'from_user_id');
    }

    public function receivedTransactions()
    {
        return $this->hasMany(Transaction::class, 'to_user_id');
    }
}
