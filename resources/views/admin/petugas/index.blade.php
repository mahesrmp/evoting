@extends('layout.admin.dash')

@section('content')
    <div class="page-body">
        <div class="container-xl">

            <div class="row">
                @if (Session::get('success'))
                    <div class="alert alert-success">

                        {{ Session::get('success') }}
                    </div>
                @endif
                @if (Session::get('error'))
                    <div class="alert alert-danger">

                        {{ Session::get('error') }}

                    </div>
                @endif

            </div>
            <div class="row mt-2">
                <div class="col-3">
                    <div class="card" style="background-color: #1A5F7A">
                        <div class="card-body">
                            <p class="text-center text-white "><strong>Data Petugas</strong></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <a href="#" class="btn btn-primary" id="tambah_departemen"><svg
                                            xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 5l0 14"></path>
                                            <path d="M5 12l14 0"></path>
                                        </svg>Tambah Data Petugas</a>
                                </div>
                            </div>
                            <div id="table-default" class="table-responsive">
                                <table class="table table-bordered data-table display nowrap w-100" id="data">
                                    <thead class="text-center">
                                        <tr>
                                            <th><button class="table-sort" data-sort="sort-name">No</button>
                                            </th>
                                            <th><button class="table-sort" data-sort="sort-city">Username</button></th>
                                            <th><button class="table-sort" data-sort="sort-city">level</button></th>
                                            <th><button class="table-sort" data-sort="sort-city">Aksi</button></th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-tbody">
                                        @php
                                            $incrementalCounter = 1;
                                        @endphp
                                        @foreach ($petugas as $item)
                                            <tr>
                                                <td>{{ $incrementalCounter++ }}</td>
                                                <td>{{ $item->username }}</td>
                                                <td>{{ $item->role }}</td>
                                                <td>
                                                    <a href="/petugas/edit/{{ $item->id }}"
                                                        class=" btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-pencil-plus" width="24"
                                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                            </path>
                                                            <path
                                                                d="M8 20l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4h4z">
                                                            </path>
                                                            <path d="M13.5 6.5l4 4"></path>
                                                            <path d="M16 18h4m-2 -2v4"></path>
                                                        </svg> </a>

                                                    <form method="POST" action="/petugas/{{ $item->id }}/delete"
                                                        class="mt-2">
                                                        @csrf

                                                        <a class="btn btn-danger deletecom">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="icon icon-tabler icon-tabler-trash" width="24"
                                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                                </path>
                                                                <path d="M4 7l16 0"></path>
                                                                <path d="M10 11l0 6"></path>
                                                                <path d="M14 11l0 6"></path>
                                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12">
                                                                </path>
                                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3">
                                                                </path>
                                                            </svg>
                                                        </a>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal_departemen" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Petugas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/petugas-add" method="POST" id="form_departemen" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-label">Username</div>

                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-file-description" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                            <path
                                                d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                            </path>
                                            <path d="M9 17h6"></path>
                                            <path d="M9 13h6"></path>
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="username" name="username"
                                        placeholder="Username" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-label">Password</div>

                                    <div class="input-icon mb-3">
                                        <span class="input-icon-addon">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-file-description" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                <path
                                                    d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                                </path>
                                                <path d="M9 17h6"></path>
                                                <path d="M9 13h6"></path>
                                            </svg>
                                        </span>
                                        <input type="password" value="" id="password" name="password"
                                            placeholder="Password" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <div class="form-group">
                                        <button class="btn btn-primary w-100" type="submit">Simpan</button>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('myscript')
    <script>
        $(document).ready(function() {
            $('#data').DataTable({
                scrollX: true,
            });
        });

        $(function() {
            $("#tambah_departemen").click(function() {
                $("#modal_departemen").modal("show");


            });
            $(".deletecom").click(function(e) {
                var form = $(this).closest('form');
                e.preventDefault();
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Ingin menghapus surat izin ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        Swal.fire(

                            'Deleted!',
                            'Your data has been deleted.',
                            'success'
                        )
                    }
                })
            });
            $(".edit").click(function() {
                var kode_dept = $(this).attr('kode_dept')
                $.ajax({
                    type: 'POST',
                    url: '/departemen/edit',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        kode_dept: kode_dept
                    },
                    success: function(respond) {
                        $("#loadeditform").html(respond);
                    }

                })
                $("#modaledit_departemen").modal("show");


            });

            $("#form_departemen").submit(function() {
                var keterangan = $("#keterangan").val();
                var foto = $("#foto").val();

                if (keterangan == "") {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'warning',
                        title: 'Keterangan Harus Diisi',
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        $("#keterangan").focus()
                    });;
                    return false;
                } else if (foto == "") {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'warning',
                        title: 'Foto Kandidat Harus Ada',
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        $("#foto").focus()
                    });;
                    return false;
                } else if (mulai == "") {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'warning',
                        title: 'Tanggal Mulai Harus Diisi',
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        $("#mulai").focus()
                    });;
                    return false;
                } else if (selesai == "") {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'warning',
                        title: 'Tanggal Selesai Harus Diisi',
                        showConfirmButton: true,
                        timer: 2000
                    }).then((result) => {
                        $("#selesai").focus()
                    });;
                    return false;
                }
            });
        })
    </script>
@endpush
