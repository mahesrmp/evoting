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
                            <p class="text-center text-white "><strong>Suara Kandidat Komandan Resimen</strong></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="table-default" class="table-responsive">
                                <table class="table table-bordered data-table display nowrap w-100" id="data">
                                    <thead class="text-center">
                                        <tr>
                                            <th><button class="table-sort" data-sort="sort-name">No</button>
                                            </th>
                                            <th><button class="table-sort" data-sort="sort-city">Kandidat</button></th>
                                            <th><button class="table-sort" data-sort="sort-city">Pemilih</button></th>
                                            <th><button class="table-sort" data-sort="sort-city">Waktu Memilih</button></th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-tbody">
                                        @php
                                            $incrementalCounter = 1;
                                        @endphp
                                        @foreach ($votes as $item)
                                            <tr>
                                                <td>{{ $incrementalCounter++ }}</td>
                                                <td>{{ $item->nama_calon }}</td>
                                                <td>{{ $item->username }}</td>
                                                <td>{{ $item->created_at }}</td>
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
@endsection
@push('myscript')
    <script>
        $(document).ready(function() {
            $('#data').DataTable({
                scrollX: true,
            });
        });
    </script>
@endpush
