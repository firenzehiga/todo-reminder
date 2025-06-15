@extends('layouts.admin')

@section('title', 'Data Mahasiswa')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.mentor') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Mahasiswa</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Mahasiswa</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addStudentModal">
                <i class="fas fa-plus"></i> Tambah Mahasiswa
            </button>
        </div>
    </div>
    <div class="card-body">
        <table id="studentsTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Tanggal Daftar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Ahmad Rizki</td>
                    <td>ahmad@example.com</td>
                    <td>2024-01-15</td>
                    <td><span class="badge badge-success">Aktif</span></td>
                    <td>
                        <button class="btn btn-info btn-sm"><i class="fas fa-eye"></i></button>
                        <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Siti Nurhaliza</td>
                    <td>siti@example.com</td>
                    <td>2024-01-20</td>
                    <td><span class="badge badge-success">Aktif</span></td>
                    <td>
                        <button class="btn btn-info btn-sm"><i class="fas fa-eye"></i></button>
                        <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Budi Santoso</td>
                    <td>budi@example.com</td>
                    <td>2024-02-01</td>
                    <td><span class="badge badge-warning">Pending</span></td>
                    <td>
                        <button class="btn btn-info btn-sm"><i class="fas fa-eye"></i></button>
                        <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Student Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Mahasiswa Baru</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addStudentForm">
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="course">Kursus</label>
                        <select class="form-control select2" id="course" name="course" multiple>
                            <option value="laravel">Laravel Fundamentals</option>
                            <option value="vue">Vue.js Basics</option>
                            <option value="react">React Development</option>
                        </select>
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
$(document).ready(function() {
    // Initialize DataTable
    $('#studentsTable').DataTable({
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#studentsTable_wrapper .col-md-6:eq(0)');

    // Initialize Select2
    $('.select2').select2({
        theme: 'bootstrap4'
    });
});
</script>
@endpush
