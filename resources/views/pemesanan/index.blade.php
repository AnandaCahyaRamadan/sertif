@extends('adminlte::page')

@section('title', 'Kelola Pemesanan')

@section('content_header')
    <h1 class="m-0 text-dark">Kelola Pemesanan</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Start kode untuk form pencarian -->
                    <form class="form" method="get" action="{{ route('pesan/search') }}">
                            <div class="form-group w-100 mb-3">
                                <label for="search" class="d-block mr-2">Cari Data Pesanan</label>
                                    <input type="text" name="search" class="form-control w-75 d-inline" id="search" placeholder="Masukkan tanggal pemesanan">
                                     <button type="submit" class="btn btn-primary mb-1">Cari</button>
                            </div>
                        </form>
                    <!-- Start kode untuk form pencarian -->
                    @if ($message = Session::get('success'))
                     <div class="alert alert-success">
                        <p>{{ $message }}</p>
                     </div>
                    @endif
                    <a href="{{route('pemesanan.create')}}" class="btn btn-primary mb-2">
                        Tambah
                    </a>

                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Nama Pelanggan</th>
                            <th>Merk Gitar</th>
                            <th>Keterangan</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pemesanan as $key => $order)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$order->tanggal_pesan}}</td>
                                <td>
                                {{$order->pelanggan->nama}}
                                </td>
                                <td>
                                {{$order->gitar->merk}}
                                </td>
                                <td>{{$order->keterangan}}</td>
                                <td>
                                    <a href="{{route('pemesanan.edit', $order)}}" class="btn btn-primary btn-xs">
                                        Edit
                                    </a>
                                    <a href="{{route('pemesanan.destroy', $order)}}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class=mt-2>
                        Current Page : {{ $pemesanan->currentPage() }} <br>
                        Jumlah Data : {{ $pemesanan->total() }} <br>
                        Data perhalaman : {{ $pemesanan->perPage() }} <br>
                        {{ $pemesanan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <form action="" id="delete-form" method="post">
        @method('delete')
        @csrf
    </form>
    <script>
        $('#example2').DataTable({
            "responsive": true,
        });

        function notificationBeforeDelete(event, el) {
            event.preventDefault();
            if (confirm('Apakah anda yakin akan menghapus data ? ')) {
                $("#delete-form").attr('action', $(el).attr('href'));
                $("#delete-form").submit();
            }
        }

    </script>
@endpush
