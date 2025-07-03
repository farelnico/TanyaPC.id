<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Consultant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    /* ----------------------------------------------------------
       CONSTRUCTOR – pastikan semua fungsi hanya untuk user login
    ---------------------------------------------------------- */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ==========================================================
       0.  LIST “BOOKING SAYA”
       GET  /booking          →  route('booking.list')
    ========================================================== */
    public function index()
    {
        $bookings = Booking::with(['consultant.user'])
            ->where('user_id', Auth::id())
            ->orderByDesc('date')
            ->orderByDesc('time')
            ->paginate(10);

        return view('booking.list', compact('bookings'));
    }

    /* ==========================================================
       1.  FORM PILIH TANGGAL & JAM
       GET  /booking/{consultant:slug}  →  route('booking.create')
    ========================================================== */
    public function create(Consultant $consultant)
    {
        /* --- jam kerja konsultan --- */
        [$start, $end] = $consultant->working_hours
            ? explode('-', $consultant->working_hours)
            : ['09:00', '17:00'];                       // default

        $slots = $this->generateSlots($start, $end);    // ["09:00","09:30", …]

        /* --- slot terpakai 5 hari ke depan --- */
        $taken = Booking::where('consultant_id', $consultant->id)
            ->whereDate('date', '>=', today())
            ->pluck('time', 'date')                     // [tgl => jam]
            ->groupBy(fn ($time, $date) => $date);      // [tgl => [jam,…]]

        return view('booking.form', [
            'consultant' => $consultant,
            'slots'      => $slots,
            'taken'      => $taken,
            'days'       => 5,                          // tampilkan 5 hari ke depan
        ]);
    }

    /* ==========================================================
       2.  SIMPAN BOOKING
       POST /booking/{consultant:slug}  →  route('booking.store')
    ========================================================== */
    public function store(Request $request, Consultant $consultant)
    {
        $data = $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
        ]);

        /* --- pastikan slot belum terisi --- */
        $exists = Booking::where('consultant_id', $consultant->id)
            ->whereDate('date', $data['date'])
            ->whereTime('time', $data['time'])
            ->exists();

        if ($exists) {
            return back()
                ->withErrors('Slot sudah terisi, pilih waktu lain.')
                ->withInput();
        }

        /* --- buat record booking --- */
        $booking = Booking::create([
            'user_id'       => Auth::id(),
            'consultant_id' => $consultant->id,
            'date'          => $data['date'],
            'time'          => $data['time'],
            'mode'          => $r->mode ?? 'online', 
            'status'        => 'pending', // menunggu admin / konsultan approve
        ]);

        return redirect()
            ->route('booking.show', $booking->id)
            ->with('status', 'Booking berhasil dikirim – menunggu persetujuan.');
    }

    /* ==========================================================
       3.  TIKET BOOKING (DETAIL)
       GET  /booking/tiket/{booking}  →  route('booking.show')
       Policy “can:view,booking” sudah di‑route di web.php
    ========================================================== */
    public function show(Booking $booking)
    {
        return view('booking.show', compact('booking'));
    }

    /* ==========================================================
       4.  HELPER – generate slot 30‑menit di antara $start‑$end
    ========================================================== */
    private function generateSlots(string $start, string $end): array
    {
        $slots = [];
        $t     = Carbon::createFromFormat('H:i', $start);
        $last  = Carbon::createFromFormat('H:i', $end);

        while ($t < $last) {
            $slots[] = $t->format('H:i');
            $t->addMinutes(30);
        }
        return $slots;
    }
}
