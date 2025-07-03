@extends('admin.layout')
@section('content')
<h4 class="mb-3">{{ $consultant ? 'Edit Konsultan' : 'Tambah Konsultan' }}</h4>

@if($errors->any())
  <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif
@if(session('status'))
  <div class="alert alert-success">{{ session('status') }}</div>
@endif

@php
    $hours = $consultant && $consultant->working_hours
              ? explode('-', $consultant->working_hours) : [];
    $startDefault = $hours[0] ?? '';
    $endDefault   = $hours[1] ?? '';
    $modeDefault  = old('mode', $consultant->mode ?? 'online');
@endphp

<form method="POST"
      action="{{ $consultant
                  ? route('adm.consult.update', $consultant->id)
                  : route('adm.consult.store') }}"
      enctype="multipart/form-data">
    @csrf
    @if($consultant) @method('PUT') @endif

    <div class="row g-3">

        {{-- NAMA --}}
        <div class="col-md-6">
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', $consultant->user->name ?? '') }}" required>
        </div>

        {{-- EMAIL --}}
        <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control"
                   value="{{ old('email', $consultant->user->email ?? '') }}" required>
        </div>

        {{-- PASSWORD (saat tambah) --}}
        @unless($consultant)
            <div class="col-md-6">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Ulangi Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
        @endunless

        {{-- SLUG --}}
        <div class="col-md-6">
            <label class="form-label">Slug Url</label>
            <input type="text" name="slug" class="form-control"
                   value="{{ old('slug', $consultant->slug ?? '') }}" required>
            <div class="form-text">Contoh: <code>ahmad-tech</code></div>
        </div>

        {{-- SPESIALISASI --}}
        <div class="col-md-6">
            <label class="form-label">Spesialisasi</label>
            <input type="text" name="specialization" class="form-control"
                   value="{{ old('specialization', $consultant->specialization ?? '') }}" required>
        </div>

        {{-- TARIF --}}
        <div class="col-md-6">
            <label class="form-label">Tarif / Sesi (Rp)</label>
            <input type="number" name="rate" class="form-control"
                   value="{{ old('rate', $consultant->rate ?? 0) }}" required>
        </div>

        {{-- JAM OPERASI --}}
        <div class="col-md-6">
            <label class="form-label">Jam Operasi</label>
            <div class="input-group">
                <input type="time" name="start_hour" class="form-control"
                       value="{{ old('start_hour', $startDefault) }}">
                <span class="input-group-text">–</span>
                <input type="time" name="end_hour" class="form-control"
                       value="{{ old('end_hour', $endDefault) }}">
            </div>
            <div class="form-text">Contoh: 09:00 – 17:00</div>
        </div>

        {{-- MODE LAYANAN --}}
        <div class="col-md-6">
            <label class="form-label">Mode Layanan</label>
            <select name="mode" id="modeSelect" class="form-select" required>
                @foreach(['online'=>'Online','offline'=>'Offline','both'=>'Online & Offline'] as $key=>$label)
                    <option value="{{ $key }}"
                    {{ $modeDefault == $key ? 'selected' : '' }}>
                    {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- GOOGLE MAP LINK (hanya jika offline/both) --}}
        <div class="col-md-6" id="mapGroup" style="display: {{ $modeDefault === 'online' ? 'none' : 'block' }}">
            <label class="form-label">Google Map Link (offline)</label>
            <input type="url" name="map_link" class="form-control"
                   value="{{ old('map_link', $consultant->map_link ?? '') }}"
                   placeholder="https://maps.google.com/...">
            <div class="form-text">Embed atau share‑link Google Maps lokasi konsultasi offline.</div>
        </div>

        {{-- FOTO --}}
        <div class="col-md-6">
            <label class="form-label">Foto</label>
            <input type="file" name="photo" class="form-control">
            @if($consultant && $consultant->photo)
                <img src="{{ asset('storage/'.$consultant->photo) }}"
                     class="mt-2 rounded" width="120">
            @endif
        </div>

        {{-- BIO --}}
        <div class="col-12">
            <label class="form-label">Bio</label>
            <textarea name="bio" rows="4" class="form-control">{{ old('bio', $consultant->bio ?? '') }}</textarea>
        </div>

    </div>

    <button class="btn btn-primary mt-3">Simpan</button>
    <a href="{{ route('adm.consult.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</form>
@endsection

@push('scripts')
<script>
  const modeSelect = document.getElementById('modeSelect');
  const mapGroup   = document.getElementById('mapGroup');

  modeSelect.addEventListener('change', function () {
    mapGroup.style.display = (this.value === 'online') ? 'none' : 'block';
  });
</script>
@endpush
