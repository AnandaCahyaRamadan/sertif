@extends('adminlte::page')

@section('title', 'Edit Data Pelanggan')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Data Pelanggan</h1>
@stop

@section('content')
    <form action="{{route('pelanggan.update', $pelanggan)}}" method="post">
        @method('PUT')
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                <div class="form-group">
                        <label for="exampleInputName">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="exampleInputName" placeholder="Nama lengkap" name="nama" value="{{$pelanggan->nama ?? old('nama')}}">
                        @error('nama') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputHp">Nomor HP</label>
                        <input type="text" class="form-control @error('nomor_hp') is-invalid @enderror" id="exampleInputHp" placeholder="Masukkan Nomor HP" name="nomor_hp" value="{{$pelanggan->nomor_hp ?? old('nomor_hp')}}">
                        @error('nomor_hp') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputAlamat">Alamat</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="exampleInputAlamat" placeholder="Masukkan Alamat" name="alamat" value="{{$pelanggan->alamat ?? old('alamat')}}">
                        @error('alamat') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('pelanggan.index')}}" class="btn btn-default">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop