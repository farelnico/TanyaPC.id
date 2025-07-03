<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class AdminBookingController extends Controller
{
    /* =======================================================
       1.  LIST BOOKING (tabel admin)
    =======================================================*/
    public function index()
    {
        // with() mencegah N+1:  booking → consultant → user
        $bookings = Booking::with(['user', 'consultant.user'])
                           ->latest()          // terbaru di atas
                           ->paginate(15);

        return view('admin.bookings.index', compact('bookings'));
    }

    /* =======================================================
       2.  UPDATE STATUS  (approve / reject / done)
    =======================================================*/
    public function updateStatus(Request $r, $id)
    {
        /* ---------- VALIDASI INPUT ---------- */
        $r->validate([
            'status'    => 'required|in:approved,rejected,done',
            'zoom_link' => 'nullable|url',
            'map_link'  => 'nullable|url',
        ]);

        /* ---------- AMBIL & UPDATE ---------- */
        $booking = Booking::findOrFail($id);
        $booking->status = $r->status;

        /* 1) Reset link jika bukan approved */
        if ($r->status !== 'approved') {
            $booking->zoom_link = null;
            $booking->map_link  = null;
        }

        /* 2) Jika APPROVED → simpan link sesuai mode konsultan */
        if ($r->status === 'approved') {
            $mode = $booking->consultant->mode;                   // online | offline | both

            // ---- Online ----
            if ($mode === 'online' && $r->filled('zoom_link')) {
                $booking->zoom_link = $r->zoom_link;
            }

            // ---- Offline / Both ----
            if (in_array($mode, ['offline', 'both']) && $r->filled('map_link')) {
                $booking->map_link = $r->map_link;
            }
        }

        $booking->save();

        /* (Opsional) Kirim notifikasi ke user di sini */

        return back()->with('status', 'Status booking diperbarui');
    }
}
