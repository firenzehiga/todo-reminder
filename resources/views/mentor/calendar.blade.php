@extends('layouts.admin')

@section('title', 'Kalender')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.mentor') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Kalender</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Kalender Kegiatan</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addEventModal">
                <i class="fas fa-plus"></i> Tambah Event
            </button>
        </div>
    </div>
    <div class="card-body">
        <div id="calendar"></div>
    </div>
</div>

<!-- Add Event Modal -->
<div class="modal fade" id="addEventModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Event Baru</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addEventForm">
                    <div class="form-group">
                        <label for="eventTitle">Judul Event</label>
                        <input type="text" class="form-control" id="eventTitle" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="eventDate">Tanggal</label>
                        <input type="date" class="form-control" id="eventDate" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="eventTime">Waktu</label>
                        <input type="time" class="form-control" id="eventTime" name="time">
                    </div>
                    <div class="form-group">
                        <label for="eventDescription">Deskripsi</label>
                        <textarea class="form-control" id="eventDescription" name="description" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: [
            {
                title: 'Kelas Laravel',
                start: '2024-01-15T10:00:00',
                end: '2024-01-15T12:00:00',
                color: '#007bff'
            },
            {
                title: 'Review Tugas',
                start: '2024-01-18T14:00:00',
                end: '2024-01-18T16:00:00',
                color: '#28a745'
            },
            {
                title: 'Meeting dengan Tim',
                start: '2024-01-20T09:00:00',
                end: '2024-01-20T10:30:00',
                color: '#ffc107'
            }
        ],
        editable: true,
        selectable: true,
        select: function(info) {
            $('#eventDate').val(info.startStr);
            $('#addEventModal').modal('show');
        },
        eventClick: function(info) {
            if (confirm('Hapus event "' + info.event.title + '"?')) {
                info.event.remove();
                toastr.success('Event berhasil dihapus');
            }
        }
    });
    calendar.render();
});
</script>
@endpush
