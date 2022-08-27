@extends('adminlte::page')

@section('title', 'Daftar Pelanggan')

@section('content_header')
    <h1 class="m-0 text-dark">Daftar Pelanggan</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
             <!-- Start kode untuk form pencarian -->
             <form class="form" method="get" action="{{ route('plgn/search') }}">
                            <div class="form-group w-100 mb-3">
                                <label for="search" class="d-block mr-2">Cari Data Pelanggan</label>
                                    <input type="text" name="search" class="form-control w-75 d-inline" id="search" placeholder="Masukkan nama pelanggan">
                                     <button type="submit" class="btn btn-primary mb-1">Cari</button>
                            </div>
                        </form>
                    <!-- Start kode untuk form pencarian -->
                    @if ($message = Session::get('success'))
                     <div class="alert alert-success">
                        <p>{{ $message }}</p>
                     </div>
                    @endif
                    <a href="{{route('pelanggan.create')}}" class="btn btn-primary mb-2">
                        Tambah
                    </a>

                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>No Hp</th>
                            <th>Alamat</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pelanggan as $key => $customer)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$customer->nama}}</td>
                                <td>{{$customer->nomor_hp}}</td>
                                <td>{{$customer->alamat}}</td>
                                <td>
                                    <a href="{{route('pelanggan.edit', $customer)}}" class="btn btn-primary btn-xs">
                                        Edit
                                    </a>
                                    <a href="{{route('pelanggan.destroy', $customer)}}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class=mt-2>
                        Current Page : {{ $pelanggan->currentPage() }} <br>
                        Jumlah Data : {{ $pelanggan->total() }} <br>
                        Data perhalaman : {{ $pelanggan->perPage() }} <br>
                        {{ $pelanggan->links() }}
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