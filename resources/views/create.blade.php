@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center mt-4">
    <div class="card shadow p-4" style="max-width: 800px; width: 100%;">

        <h4 class="mb-4">Formulir Pengiriman Paket Baru</h4>

        <form action="{{ route('create') }}" method="POST">
            @csrf

            {{-- DATA PENGIRIM --}}
            <fieldset class="border p-3 mb-4 rounded">
                <legend class="float-none w-auto px-2">Data Pengirim</legend>

                <div class="mb-3">
                    <label class="form-label">Nama:</label>
                    <input type="text" name="sender_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">No. Telepon:</label>
                    <input type="text" name="sender_phone" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat:</label>
                    <textarea name="sender_address" class="form-control" rows="3" required></textarea>
                </div>
            </fieldset>

            {{-- DATA PENERIMA --}}
            <fieldset class="border p-3 mb-4 rounded">
                <legend class="float-none w-auto px-2">Data Penerima</legend>

                <div class="mb-3">
                    <label class="form-label">Nama:</label>
                    <input type="text" name="receiver_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">No. Telepon:</label>
                    <input type="text" name="receiver_phone" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat:</label>
                    <textarea name="receiver_address" class="form-control" rows="3" required></textarea>
                </div>
            </fieldset>

            {{-- INFORMASI PAKET --}}
            <fieldset class="border p-3 mb-4 rounded">
                <legend class="float-none w-auto px-2">Informasi Paket</legend>

                <div class="mb-3">
                    <label class="form-label">Berat Paket (kg):</label>
                    <input type="number" name="weight" class="form-control" step="0.1" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Barang:</label>
                    <textarea name="description" class="form-control" rows="3" required></textarea>
                </div>
            </fieldset>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">Simpan Pengiriman</button>
            </div>

        </form>

    </div>
</div>
@endsection
