<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Messages\AcountWasDisabled;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate();

        return view('admin.users.index', compact('users'));
    }

    public function toggle(User $user): RedirectResponse
    {
        $user->toggle();
        $user->save();

        if (!$user->enabled) {
            Notification::route('nexmo', '573185344785')
                ->notify(new AcountWasDisabled());
        }

        return back();
    }
}
