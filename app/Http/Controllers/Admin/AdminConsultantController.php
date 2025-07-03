<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Consultant;
use Illuminate\Support\Facades\Hash;

class AdminConsultantController extends Controller
{
    /* =======================================================
       LIST KONSULTAN
    =======================================================*/
    public function index()
    {
        $consultants = Consultant::with('user')->paginate(10);
        return view('admin.consultants.index', compact('consultants'));
    }

    /* =======================================================
       FORM TAMBAH
    =======================================================*/
    public function create()
    {
        return view('admin.consultants.form', ['consultant' => null]);
    }

    /* =======================================================
       SIMPAN DATA BARU
    =======================================================*/
    public function store(Request $r)
    {
        $data = $r->validate([
            'name'           => 'required|string|max:120',
            'email'          => 'required|email|unique:users,email',
            'password'       => 'required|min:6|confirmed',
            'slug'           => 'required|unique:consultants,slug',
            'specialization' => 'required|string|max:120',
            'bio'            => 'nullable|string',
            'rate'           => 'required|numeric|min:0',
            'photo'          => 'nullable|image|max:2048',
            'start_hour'     => 'nullable|date_format:H:i',
            'end_hour'       => 'nullable|date_format:H:i|after:start_hour',
            'mode'           => 'required|in:online,offline,both',
            'map_link'       => 'nullable|url',              // ⇠ NEW
        ]);

        /* satukan jam kerja */
        $working = $r->start_hour && $r->end_hour
                   ? $r->start_hour.'-'.$r->end_hour
                   : null;

        /* Buat user login */
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => 'konsultan',
        ]);

        /* upload foto jika ada */
        if ($r->hasFile('photo')) {
            $data['photo'] = $r->file('photo')->store('consultants', 'public');
        }

        /* Buat data konsultan */
        Consultant::create([
            'user_id'        => $user->id,
            'slug'           => $data['slug'],
            'specialization' => $data['specialization'],
            'bio'            => $data['bio'] ?? null,
            'rate'           => $data['rate'],
            'photo'          => $data['photo'] ?? null,
            'working_hours'  => $working,
            'mode'           => $data['mode'],
            'map_link'       => $data['map_link'] ?? null,  // ⇠ NEW
            'is_active'      => true,
        ]);

        return redirect()->route('adm.consult.index')
                         ->with('status', 'Konsultan ditambahkan');
    }

    /* =======================================================
       FORM EDIT
    =======================================================*/
    public function edit($id)
    {
        $consultant = Consultant::with('user')->findOrFail($id);
        return view('admin.consultants.form', compact('consultant'));
    }

    /* =======================================================
       UPDATE DATA
    =======================================================*/
    public function update(Request $r, $id)
    {
        $consultant = Consultant::with('user')->findOrFail($id);

        $data = $r->validate([
            'name'           => 'required|string|max:120',
            'email'          => 'required|email|unique:users,email,'.$consultant->user_id,
            'slug'           => 'required|unique:consultants,slug,'.$consultant->id,
            'specialization' => 'required|string|max:120',
            'bio'            => 'nullable|string',
            'rate'           => 'required|numeric|min:0',
            'photo'          => 'nullable|image|max:2048',
            'start_hour'     => 'nullable|date_format:H:i',
            'end_hour'       => 'nullable|date_format:H:i|after:start_hour',
            'mode'           => 'required|in:online,offline,both',
            'map_link'       => 'nullable|url',              // ⇠ NEW
        ]);

        /* satukan jam kerja */
        $working = $r->start_hour && $r->end_hour
                   ? $r->start_hour.'-'.$r->end_hour
                   : null;

        /* update data user */
        $consultant->user->update([
            'name'  => $data['name'],
            'email' => $data['email'],
        ]);

        /* upload foto baru jika ada */
        if ($r->hasFile('photo')) {
            $data['photo'] = $r->file('photo')->store('consultants', 'public');
        }

        /* array update konsultan */
        $updateData = [
            'slug'           => $data['slug'],
            'specialization' => $data['specialization'],
            'bio'            => $data['bio'] ?? null,
            'rate'           => $data['rate'],
            'working_hours'  => $working,
            'mode'           => $data['mode'],
            'map_link'       => $data['map_link'] ?? null, // ⇠ NEW
        ];
        if (isset($data['photo'])) $updateData['photo'] = $data['photo'];

        $consultant->update($updateData);

        return back()->with('status', 'Konsultan diperbarui');
    }

    /* =======================================================
       TOGGLE AKTIF/NONAKTIF
    =======================================================*/
    public function toggle($id)
    {
        $c = Consultant::findOrFail($id);
        $c->is_active = ! $c->is_active;
        $c->save();

        return back()->with('status', 'Status konsultan diubah');
    }
}
