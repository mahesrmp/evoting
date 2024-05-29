@extends('layout.pemilih.dash')

@section('content')
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
    @if (auth()->user()->status_vote_ketua == 1)
        <h1 class="profile-username text-center text-white"><b>Kamu sudah menggunakan hak suara kamu</b></h1>
    @else
        <style>
            .card-img {
                width: 100%;
                height: 300px;
                object-fit: cover;
            }
        </style>
        <div class="row justify-content-center">
            @foreach ($dataCalonKetua as $item)
                <div class="col-md-4 mt-4">
                    <div class="card card-primary card-outline h-100 d-flex flex-column"
                        style="display: flex; flex-direction: column;">
                        <div class="card-body d-flex flex-column"
                            style="display: flex; flex-direction: column; height: 100%;">
                            <h4 class="profile-username text-center">
                                {{ $item->no_urut }}
                            </h4>
                            <div class="row">
                                <h2 class="profile-username text-center">
                                    {{ $item->nama_calon }}
                                </h2>
                            </div>
                            <div class="row">
                                <div class="text-center">
                                    <img style="width: auto; height: 419px"
                                        src="{{ url('asset/kandidat2/' . $item->foto_calon) }}"
                                        alt="{{ $item->foto_calon }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <div class="form-label">Keterangan</div>
                                        <div class="input-icon mb-3">
                                            <h4>{!! $item->keterangan !!}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-top: auto;">
                                <center>
                                    <a href="/pilihKandidatKetua/{{ $item->id }}" class="btn btn-primary">
                                        <i class="fa fa-edit"></i> Pilih
                                    </a>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
