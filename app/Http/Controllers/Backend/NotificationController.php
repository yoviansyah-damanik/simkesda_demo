<?php

namespace App\Http\Controllers\Backend;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::latest()
            ->paginate(config('app.pagination_length'))
            ->withQueryString();

        return view('backend.pages.notification.index', [
            'notifications' => $notifications
        ]);
    }

    public function create()
    {
        return view('backend.pages.notification.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required'
        ], [], [
            'title' => 'Judul Notifikasi',
            'body' => 'Isi announcement'
        ]);

        $validatedData['user_id'] = Auth::id();
        $validatedData['is_active'] = 0;

        Notification::create($validatedData);

        Alert::success('Sukses!', 'Berhasil menambahkan notifikasi dasbor.');
        return redirect()
            ->route('dashboard.notification');
    }

    public function edit(Notification $notification)
    {
        return view('backend.pages.notification.edit', [
            'notification' => $notification
        ]);
    }

    public function update(Request $request, Notification $notification)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required'
        ], [], [
            'title' => 'Judul Notifikasi',
            'body' => 'Isi Notifikasi Dasbor'
        ]);

        $notification->slug = null;
        $notification->update($validatedData);

        Alert::success('Sukses!', 'Berhasil memperbaharui notifikasi dasbor.');
        return redirect()->route('dashboard.notification.edit', $notification->slug);
    }

    public function activation(Request $request)
    {
        $id = $request->id;
        $stat = $request->stat;

        Notification::where('id', '!=', null)
            ->update(['is_active' => 0]);

        Notification::where('id', $id)
            ->update(['is_active' => $stat]);

        Alert::success('Sukses!', 'Berhasil mengubah status.');
        return redirect()
            ->route('dashboard.notification');
    }
}
