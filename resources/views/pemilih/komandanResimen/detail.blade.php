@extends('layout.pemilih.dash')

@section('content')
    <style>
        .card-img {
            width: 100%;
            height: 300px;
            /* Atur tinggi gambar sesuai kebutuhan */
            object-fit: cover;
            /* Agar gambar selalu memenuhi area */
        }
    </style>
    <div class="row">
        @php
            $incrementalCounter = 1;
        @endphp
        @foreach ($dataCalon as $item)
            <div class="col-md-4 mt-4">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <h4 class="profile-username text-center">
                            {{ $incrementalCounter++ }}
                        </h4>
                        <div class="text-center">
                            <a href="{{ url('asset/kandidat/' . $item->foto_calon) }}" target="_blank">
                                <img src="{{ url('asset/kandidat/' . $item->foto_calon) }}" alt="{{ $item->foto_calon }}"
                                    class="card-img">
                            </a>
                        </div>

                        <h3 class="profile-username text-center">
                            {{ $item->nama_calon }}
                        </h3>

                        <center>
                            <a href="/detailDataKandidat/{{ $item->id }}" class="btn btn-success btn-sm">
                                <i class="fa fa-file"></i> Detail
                            </a>
                            <a href="/pilihKandidat/{{ $item->id }}" class="btn btn-primary">
                                <i class="fa fa-edit"></i> Pilih
                            </a>
                        </center>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="modal modal-blur fade show" id="modal-large" tabindex="-1" role="dialog" aria-modal="true"
                style="display: block;">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Detail Data Kandidat</h5>
                            <a href="/dashboard/pemilih"><button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button></a>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <h3 class="profile-username text-center">
                                    {{ $detailDataKandidat->nama_calon }}
                                </h3>
                            </div>
                            <div class="row">
                                <div class="text-center">
                                    <a href="{{ url('asset/kandidat/' . $detailDataKandidat->foto_calon) }}"
                                        target="_blank">
                                        <img
                                            src="{{ url('asset/kandidat/' . $detailDataKandidat->foto_calon) }}"alt="{{ $detailDataKandidat->foto_calon }}">
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <div class="form-label">Keterangan</div>
                                        <div class="input-icon mb-3">
                                            <h4>{!! $detailDataKandidat->keterangan !!}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-12">
                                    <div class="form-group">
                                        <a href="/dashboard/pemilih">
                                            <button class="btn btn-primary w-100">Kembali
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
