<?php

namespace App\Http\Services;


use App\Mail\DeleteUserMail;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    /**
     * @param User $user
     *
     * @return string
     */
    public function sendDeletedUserEmail(User $user)
    {
        $data = [
            'title'     => 'Your account has been deleted',
            'username'  => $user->name,
            'subject'   => 'Your account has been deleted',
            'from'      => 'info@local.com',
            'from_name' => 'Laravel Plain Email',
        ];

        Mail::to($user->email, $user->name)->send(new DeleteUserMail($data));

        return "Delete Email Sent. Check your inbox.";
    }
}