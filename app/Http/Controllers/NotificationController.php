<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class NotificationController extends Controller
{
    public function index(): View
    {
        $notifications = auth()->user()->unreadNotifications()->get();

        return view('notifications.index', compact('notifications'));
    }

    public function mark(string $notification): RedirectResponse
    {
        auth()->user()
            ->unreadNotifications()
            ->where('id', $notification)
            ->update(['read_at' => now()]);

        return back();
    }

    public function markAll(): RedirectResponse
    {
        auth()->user()
            ->unreadNotifications()
            ->update(['read_at' => now()]);

        return redirect()->route('home');
    }
}
