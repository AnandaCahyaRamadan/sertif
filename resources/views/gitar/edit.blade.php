@extends('adminlte::page')

@section('title', 'Edit Data Gitar')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Data Gitar</h1>
@stop

@section('content')
    <form action="{{route('gitar.update', $gitar)}}" method="post"> 
        @method('PUT')
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                <div class="form-group">
                        <label for="exampleInputMerk">Merk</label>
                        <input type="text" class="form-control @error('merk') is-invalid @enderror" id="exampleInputMerk" placeholder="Merk" name="merk" value="{{$gitar->merk ?? old('merk')}}">
                        @error('merk') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputSeri">Seri</label>
                        <input type="text" class="form-control @error('seri') is-invalid @enderror" id="exampleInputSeri" placeholder="Masukkan Nomor Seri" name="seri" value="{{$gitar->seri ?? old('seri')}}">
                        @error('seri') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputJenis">Jenis</label>
                        <input type="text" class="form-control @error('jenis') is-invalid @enderror" id="exampleInputJenis" placeholder="Masukkan Jenis" name="jenis" value="{{$gitar->jenis ?? old('jenis')}}">
                        @error('jenis') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputHarga">Harga</label>
                        <input type="text" class="form-control @error('harga') is-invalid @enderror" id="exampleInputHarga" placeholder="Masukkan Harga" name="harga" value="{{$gitar->harga ?? old('harga')}}">
                        @error('harga') <span class="text-danger">{{$message}}</span> @enderror
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