<?php

namespace App\Http\Controllers;

use App\Models\Consultant;

class ConsultantListController extends Controller
{
    /* =======================================================
       DAFTAR KONSULTAN (online / offline / both)
       url: /konseling?mode=online | offline | both
    =======================================================*/
    public function index()
    {
        // mode default: 'online'
        $mode = request('mode', 'online');          // ambil dari query ?mode=

        /* --------------------------------------------------
           Ambil konsultan aktif sesuai mode:
           - online  : khusus mode 'online'
           - offline : khusus mode 'offline'
           - both    : mode 'both'
           - untuk halaman gabungan (jika diperlukan) → skip filter mode
        --------------------------------------------------*/
        $consultants = Consultant::with('user')
                        ->where('is_active', 1)
                        ->when($mode !== 'all', function ($q) use ($mode) {
                            // Jika mode 'both' → tampilkan 'both',
                            // Jika mode lain → bisa 'online' atau 'offline'
                            if ($mode === 'both') {
                                $q->where('mode', 'both');
                            } else {
                                $q->whereIn('mode', [$mode, 'both']);
                            }
                        })
                        ->paginate(12);

        // Tentukan view mana yang ingin dipakai
        $view = $mode === 'offline'
                    ? 'konseling_offline'
                    : 'konseling_online';          // default pakai view online

        return view($view, compact('consultants'));
    }

    /* =======================================================
       ALIAS lama (opsional) – demi kompatibilitas
    =======================================================*/
    public function online()
    {
        // /konseling_online langsung arahkan ke index dengan mode online
        return $this->index();
    }

    public function offline()
    {
        // /konseling_offline arahkan index dengan mode=offline
        request()->merge(['mode' => 'offline']);
        return $this->index();
    }
}
