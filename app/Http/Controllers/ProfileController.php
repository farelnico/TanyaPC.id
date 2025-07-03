<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', ['user' => auth()->user()]);
    }

    public function update(Request $r)
    {
        $data = $r->validate([
            'phone'  => 'nullable|string|max:20',
            'bio'    => 'nullable|string|max:500',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($r->hasFile('avatar')) {
            // simpan avatar ke storage/app/public/avatars
            $data['avatar'] = $r->file('avatar')->store('avatars', 'public');
        }

        $r->user()->update($data);
        return back()->with('status', 'Profil diperbarui!');
    }
}
