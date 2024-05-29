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
    <div class="row justify-content-center">
        <div class="col-md-4 mt-4">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <h4 class="profile-username text-center">
                        Kandidat Pilihan Anda
                    </h4>
                    <div class="text-center">
                        <img src="{{ url('asset/kandidat/' . $pilihKandidat->foto_calon) }}"
                            alt="{{ $pilihKandidat->foto_calon }}" class="card-img">
                    </div>

                    <h3 class="profile-username text-center">
                        {{ $pilihKandidat->nama_calon }}
                    </h3>

                    <center>
                        <form action="{{ route('pilihpros', $pilihKandidat->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-edit"></i> Tetapkan Pilihan
                            </button>
                        </form>
                    </center>
                </div>
            </div>
        </div>
    </div>
@endsection
