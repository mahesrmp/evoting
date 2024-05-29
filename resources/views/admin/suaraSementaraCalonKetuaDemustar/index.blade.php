@extends('layout.admin.dash')

@section('content')
    <div class="realtime">
        <div class="card card-info autoload">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa fa-chart-pie"></i> Perolehan Suara <br>
                    <span style="color: red;"> !Refresh Halaman Untuk melihat Perolehan Suara Sementara!</span>
                </h3>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No Urut</th>
                                <th>Nama Kandidat</th>
                                <th>
                                    <center>Foto Kandidat</center>
                                </th>
                                <th>Jumlah Suara</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $incrementalCounter = 1;
                            @endphp
                            @foreach ($calons as $calon)
                                <tr>
                                    <td>{{ $incrementalCounter++ }}</td>
                                    <td>{{ $calon->nama_calon }}</td>
                                    <td align="center">
                                        <img src="asset/kandidat2/{{ $calon->foto_calon }}" width="150px" />
                                    </td>
                                    <td>
                                        <span id="total-votes-{{ $calon->id_calon }}">{{ $calon->votes2()->count() }}</span>
                                        Suara
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
