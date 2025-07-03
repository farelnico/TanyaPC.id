@extends('admin.layout')

@section('content')
<h4 class="mb-3 d-flex justify-content-between">
  <span>Daftar Konsultan</span>
  <a href="{{ route('adm.consult.create') }}" class="btn btn-sm btn-primary">
    Tambah Konsultan
  </a>
</h4>

@if(session('status'))
  <div class="alert alert-success">{{ session('status') }}</div>
@endif

<table class="table table-hover align-middle">
  <thead class="table-light">
    <tr>
      <th>#</th>
      <th>Nama</th>
      <th>Email</th>
      <th>Spesialisasi</th>
      <th>Mode</th>      {{-- kolom baru --}}
      <th>Status</th>
      <th>Aksi</th>
    </tr>
  </thead>

  <tbody>
    @foreach($consultants as $c)
      <tr>
        {{-- penomoran tetap benar saat paginate --}}
        <td>{{ $loop->iteration + ($consultants->currentPage()-1)*$consultants->perPage() }}</td>

        <td>{{ $c->user->name }}</td>
        <td>{{ $c->user->email }}</td>
        <td>{{ $c->specialization }}</td>

        {{-- badge mode --}}
        <td>
          @php
            $clr = [
              'online'  => 'primary',
              'offline' => 'warning',
              'both'    => 'info',
            ][$c->mode];
          @endphp
          <span class="badge bg-{{ $clr }}">{{ ucfirst($c->mode) }}</span>
        </td>

        {{-- Aktif / nonaktif --}}
        <td>
          <span class="badge {{ $c->is_active ? 'bg-success':'bg-secondary' }}">
            {{ $c->is_active ? 'Aktif':'Nonaktif' }}
          </span>
        </td>

        {{-- tombol aksi --}}
        <td class="d-flex gap-2">
          <a href="{{ route('adm.consult.edit',$c->id) }}" class="btn btn-sm btn-outline-primary">
            Edit
          </a>

          <form action="{{ route('adm.consult.toggle',$c->id) }}" method="POST">
            @csrf
            <button class="btn btn-sm {{ $c->is_active ? 'btn-outline-danger' : 'btn-outline-success' }}">
              {{ $c->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
            </button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

{{-- pagination --}}
{{ $consultants->links() }}
@endsection
