@extends('layouts.admin')

@section('title', 'Dashboard Mentor')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>150</h3>
                <p>Total Mahasiswa</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ route('mentor.students') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>12</h3>
                <p>Kursus Aktif</p>
            </div>
            <div class="icon">
                <i class="fas fa-book"></i>
            </div>
            <a href="{{ route('mentor.courses') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>44</h3>
                <p>Tugas Pending</p>
            </div>
            <div class="icon">
                <i class="fas fa-tasks"></i>
            </div>
            <a href="{{ route('mentor.assignments') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>4.8</h3>
                <p>Rating</p>
            </div>
            <div class="icon">
                <i class="fas fa-star"></i>
            </div>
            <a href="{{ route('mentor.reports') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<!-- Main Dashboard Content -->
<div class="row">
    <!-- Calendar Section -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-calendar mr-1"></i>
                    Kalender Kegiatan
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addEventModal">
                        <i class="fas fa-plus"></i> Tambah Event
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div id="calendar"></div>
            </div>
        </div>
    </div>

    <!-- Right Sidebar -->
    <div class="col-md-4">
        <!-- Quick Actions -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-bolt mr-1"></i>
                    Quick Actions
                </h3>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <button class="btn btn-primary btn-block mb-2" data-toggle="modal" data-target="#addEventModal">
                        <i class="fas fa-calendar-plus"></i> Tambah Jadwal
                    </button>
                    <a href="{{ route('mentor.students') }}" class="btn btn-info btn-block mb-2">
                        <i class="fas fa-users"></i> Kelola Mahasiswa
                    </a>
                    <a href="{{ route('mentor.courses') }}" class="btn btn-success btn-block mb-2">
                        <i class="fas fa-book"></i> Kelola Kursus
                    </a>
                    <a href="{{ route('mentor.assignments') }}" class="btn btn-warning btn-block">
                        <i class="fas fa-tasks"></i> Review Tugas
                    </a>
                </div>
            </div>
        </div>

        <!-- Today's Schedule -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-clock mr-1"></i>
                    Jadwal Hari Ini
                </h3>
            </div>
            <div class="card-body">
                <div class="timeline timeline-inverse">
                    <div class="time-label">
                        <span class="bg-success">{{ date('d M Y') }}</span>
                    </div>
                    <div>
                        <i class="fas fa-chalkboard-teacher bg-primary"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="far fa-clock"></i> 09:00</span>
                            <h3 class="timeline-header">Kelas Laravel Fundamentals</h3>
                            <div class="timeline-body">
                                Sesi pembelajaran tentang Routing dan Controllers
                            </div>
                        </div>
                    </div>
                    <div>
                        <i class="fas fa-users bg-info"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="far fa-clock"></i> 14:00</span>
                            <h3 class="timeline-header">Meeting Tim Pengajar</h3>
                            <div class="timeline-body">
                                Diskusi kurikulum semester baru
                            </div>
                        </div>
                    </div>
                    <div>
                        <i class="fas fa-tasks bg-warning"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="far fa-clock"></i> 16:00</span>
                            <h3 class="timeline-header">Review Tugas Mahasiswa</h3>
                            <div class="timeline-body">
                                5 tugas menunggu untuk direview
                            </div>
                        </div>
                    </div>
                    <div>
                        <i class="far fa-clock bg-gray"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Notifications -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-bell mr-1"></i>
                    Notifikasi Terbaru
                </h3>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Ahmad Rizki</div>
                            Mengirim tugas Laravel
                        </div>
                        <span class="badge bg-primary rounded-pill">2h</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Siti Nurhaliza</div>
                            Bertanya di forum diskusi
                        </div>
                        <span class="badge bg-info rounded-pill">4h</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Sistem</div>
                            Backup database berhasil
                        </div>
                        <span class="badge bg-success rounded-pill">1d</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-line mr-1"></i>
                    Statistik Mahasiswa Bulanan
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <canvas id="studentsChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Progress Kursus
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <canvas id="coursesChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Add Event Modal -->
<div class="modal fade" id="addEventModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <i class="fas fa-calendar-plus mr-2"></i>
                    Tambah Event Baru
                </h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addEventForm">
                    <div class="form-group">
                        <label for="eventTitle">
                            <i class="fas fa-heading mr-1"></i>
                            Judul Event
                        </label>
                        <input type="text" class="form-control" id="eventTitle" name="title" placeholder="Masukkan judul event" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="eventDate">
                                    <i class="fas fa-calendar mr-1"></i>
                                    Tanggal
                                </label>
                                <input type="date" class="form-control" id="eventDate" name="date" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="eventTime">
                                    <i class="fas fa-clock mr-1"></i>
                                    Waktu
                                </label>
                                <input type="time" class="form-control" id="eventTime" name="time">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="eventType">
                            <i class="fas fa-tag mr-1"></i>
                            Tipe Event
                        </label>
                        <select class="form-control" id="eventType" name="type">
                            <option value="class">Kelas</option>
                            <option value="meeting">Meeting</option>
                            <option value="review">Review Tugas</option>
                            <option value="other">Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="eventDescription">
                            <i class="fas fa-align-left mr-1"></i>
                            Deskripsi
                        </label>
                        <textarea class="form-control" id="eventDescription" name="description" rows="3" placeholder="Deskripsi event (opsional)"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i>
                    Batal
                </button>
                <button type="button" class="btn btn-primary" onclick="addEvent()">
                    <i class="fas fa-save mr-1"></i>
                    Simpan Event
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let calendar;

document.addEventListener('DOMContentLoaded', function() {
    // Initialize Calendar
    var calendarEl = document.getElementById('calendar');
    calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 'auto',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,listWeek'
        },
        events: [
            {
                title: 'Kelas Laravel Fundamentals',
                start: '2024-01-15T09:00:00',
                end: '2024-01-15T11:00:00',
                color: '#007bff',
                textColor: '#fff'
            },
            {
                title: 'Review Tugas PHP',
                start: '2024-01-16T14:00:00',
                end: '2024-01-16T16:00:00',
                color: '#28a745',
                textColor: '#fff'
            },
            {
                title: 'Meeting Tim Pengajar',
                start: '2024-01-18T10:00:00',
                end: '2024-01-18T11:30:00',
                color: '#ffc107',
                textColor: '#000'
            },
            {
                title: 'Kelas Vue.js Basics',
                start: '2024-01-20T13:00:00',
                end: '2024-01-20T15:00:00',
                color: '#17a2b8',
                textColor: '#fff'
            },
            {
                title: 'Konsultasi Mahasiswa',
                start: '2024-01-22T16:00:00',
                end: '2024-01-22T17:00:00',
                color: '#6f42c1',
                textColor: '#fff'
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
        },
        eventDrop: function(info) {
            toastr.info('Event "' + info.event.title + '" dipindahkan');
        }
    });
    calendar.render();

    // Initialize Charts
    initializeCharts();
});

// Add Event Function
function addEvent() {
    const title = document.getElementById('eventTitle').value;
    const date = document.getElementById('eventDate').value;
    const time = document.getElementById('eventTime').value;
    const type = document.getElementById('eventType').value;
    
    if (!title || !date) {
        toastr.error('Judul dan tanggal harus diisi!');
        return;
    }
    
    const eventDateTime = time ? date + 'T' + time : date;
    const colors = {
        'class': '#007bff',
        'meeting': '#ffc107', 
        'review': '#28a745',
        'other': '#6c757d'
    };
    
    calendar.addEvent({
        title: title,
        start: eventDateTime,
        color: colors[type] || '#007bff',
        textColor: '#fff'
    });
    
    // Reset form and close modal
    document.getElementById('addEventForm').reset();
    $('#addEventModal').modal('hide');
    toastr.success('Event berhasil ditambahkan!');
}

// Initialize Charts
function initializeCharts() {
    // Students Chart
    const studentsCtx = document.getElementById('studentsChart').getContext('2d');
    const studentsChart = new Chart(studentsCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Mahasiswa Baru',
                data: [12, 19, 8, 15, 22, 18],
                borderColor: '#007bff',
                backgroundColor: 'rgba(0, 123, 255, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Courses Chart
    const coursesCtx = document.getElementById('coursesChart').getContext('2d');
    const coursesChart = new Chart(coursesCtx, {
        type: 'doughnut',
        data: {
            labels: ['Selesai', 'Dalam Progress', 'Belum Mulai'],
            datasets: [{
                data: [65, 25, 10],
                backgroundColor: ['#28a745', '#ffc107', '#dc3545'],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
}

// Initialize Toastr
toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "timeOut": "3000"
};
</script>
@endpush
