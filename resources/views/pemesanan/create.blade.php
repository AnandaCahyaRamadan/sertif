@extends('adminlte::page')

@section('title', 'Tambah Pemesanan')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Pemesanan</h1>
@stop

@section('content')
    <form action="{{route('pemesanan.store')}}" method="post">
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                <div class="form-group">
                            <label for="exampleInputPesan">Tanggal Pemesanan</label>
                            <input type="date" class="form-control @error('tanggal_pesan') is-invalid @enderror" id="exampleInputPesan" placeholder="tanggan Pesan" name="tanggal_pesan" value="{{old('tanggal_pesan')}}">
                            @error('tanggal_pesan') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                       

                        <div class="form-group">
                            <label for="position-option">Nama Pelanggan</label>
                            <select class="form-control" id="position-option" name="pelanggan_id">
                                @foreach ($customer as $pelanggan)
                                    <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="position-option">Merk Gitar</label>
                            <select class="form-control" id="position-option" name="gitar_id">
                                @foreach ($guitar as $gitar)
                                    <option value="{{ $gitar->id }}">{{ $gitar->merk }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputKet">Keterangan</label>
                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="exampleInputKet" placeholder="Keterangan" name="keterangan" value="{{old('keterangan')}}">
                            @error('keterangan') <span class="text-danger">{{$message}}</span> @enderror
                        </div>


                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('pemesanan.index')}}" class="btn btn-default">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop