<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Services\EmailService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * @var EmailService $emailService
     */
    protected $emailService;

    /**
     * UserController constructor.
     *
     * @param EmailService $emailService
     */
    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    /**
     * Display a listing of the users.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::all();

        return response()->json([
            'error' => false,
            'users' => $users
        ], 200);
    }

    /**
     * Display the specified user.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'error'   => true,
                'message' => 'The user with id ' . $id . ' not found.'
            ]);
        }

        return response()->json([
            'error' => false,
            'user'  => $user,
        ], 200);
    }

    /**
     * Update the specified user.
     *
     * @param  Request  $request
     * @param  int      $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'error'   => true,
                'message' => 'The user with id ' . $id . ' not found.'
            ]);
        }

        $user->name  = $request->input('name');
        $user->email = $request->input('email');

        $user->save();

        return response()->json([
            'error' => false,
            'user'  => $user
        ], 200);
    }

    /**
     * Remove the specified user.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'error'   => true,
                'message' => 'The user with id ' . $id . ' not found.'
            ]);
        }

        $user->delete();

        $this->emailService->sendDeletedUserEmail($user);

        return response()->json([
            'error'   => false,
            'message' => 'The user with id ' . $user->id . ' has successfully been deleted.'
        ]);
    }
}
