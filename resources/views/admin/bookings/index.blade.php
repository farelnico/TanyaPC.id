@extends('admin.layout')

@section('content')
<h4 class="mb-3">Daftar Booking</h4>

@if(session('status'))
  <div class="alert alert-success">{{ session('status') }}</div>
@endif

<table class="table table-hover align-middle">
  <thead class="table-light">
    <tr>
      <th>#</th>
      <th>User</th>
      <th>Konsultan</th>
      <th>Tanggal</th>
      <th>Jam</th>
      <th>Status</th>
      <th style="width:220px">Aksi</th>
    </tr>
  </thead>

  <tbody>
  @foreach($bookings as $b)
    @php
        $clr  = ['pending'=>'secondary','approved'=>'primary','done'=>'success','rejected'=>'danger'][$b->status];
        $mode = $b->consultant->mode;                 // online | offline | both
        $isOffline = in_array($mode,['offline','both']);
    @endphp
    <tr>
      {{-- ========= NOMOR URUT ========= --}}
      <td>{{ $loop->iteration + ($bookings->currentPage()-1)*$bookings->perPage() }}</td>

      {{-- ========= DETAIL ============== --}}
      <td>{{ $b->user->name }}</td>
      <td>{{ $b->consultant->user->name }}</td>
      <td>{{ \Carbon\Carbon::parse($b->date)->translatedFormat('d M Y') }}</td>
      <td>{{ $b->time }}</td>

      {{-- ========= STATUS BADGE ======== --}}
      <td><span class="badge bg-{{ $clr }}">{{ ucfirst($b->status) }}</span></td>

      {{-- ========= AKSI ================ --}}
      <td class="d-flex gap-1">

        {{-- ---------- STATUS : PENDING ---------- --}}
        @if($b->status === 'pending')
          {{-- Tombol buka modal  --}}
          <button class="btn btn-sm btn-success"
                  data-bs-toggle="modal"
                  data-bs-target="#accModal{{ $b->id }}">
            Approve
          </button>

          {{-- ==============  MODAL APPROVE  ============== --}}
          <div class="modal fade" id="accModal{{ $b->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <form action="{{ route('adm.book.status',$b->id) }}" method="POST">
                  @csrf
                  <input type="hidden" name="status" value="approved">

                  <div class="modal-header">
                    <h5 class="modal-title">Approve Booking #{{ $b->id }}</h5>
                  </div>

                  <div class="modal-body">
                    {{-- ONLINE → Zoom |  OFFLINE → Google Maps --}}
                    @if(!$isOffline)
                      <label class="form-label">Link Zoom (opsional)</label>
                      <input  type="url" name="zoom_link" class="form-control"
                              placeholder="https://zoom.us/j/…">
                    @else
                      <label class="form-label">Link Google Maps (opsional)</label>
                      <input  type="url" name="map_link" class="form-control"
                              placeholder="https://goo.gl/maps/…">
                    @endif
                  </div>

                  <div class="modal-footer">
                    <button class="btn btn-primary">Approve</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                      Batal
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          {{-- Tombol Tolak --}}
          <form action="{{ route('adm.book.status',$b->id) }}" method="POST">
            @csrf
            <input type="hidden" name="status" value="rejected">
            <button class="btn btn-sm btn-outline-danger">Tolak</button>
          </form>

        {{-- ---------- STATUS : APPROVED ---------- --}}
        @elseif($b->status === 'approved')
          <form action="{{ route('adm.book.status',$b->id) }}" method="POST">
            @csrf
            <input type="hidden" name="status" value="done">
            <button class="btn btn-sm btn-primary">Tandai Selesai</button>
          </form>
        @endif
      </td>
    </tr>
  @endforeach
  </tbody>
</table>

{{ $bookings->links() }}
@endsection
