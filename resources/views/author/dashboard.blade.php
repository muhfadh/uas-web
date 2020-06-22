@extends('layouts.backend.app')
@section('title', 'Dashboard')
@push('css')

@endpush
@section('content')
<div class="container-fluid">
    <!-- Widgets -->
    <div class="row clearfix">
        <div class="card">
            <div class="header">
                <a class="btn btn-primary waves-effect" href="{{ route('home') }}">
                    <i class="material-icons">home</i>
                    <span>Halaman utama</span>
                </a>
            </div>

        </div>
    </div>
    <div class="row clearfix">
        <div class="col-xs-12 col-sm-4">
            <div class="card profile-card">
                <div class="profile-header">&nbsp;</div>
                <div class="profile-body">
                    <div class="image-area">
                        <img class="" src="{{ Storage::disk('public')->url('profile/'.Auth::user()->image) }}" width="120" height="120" />
                    </div>
                    <div class="content-area">
                        <h3>Muhammad Fadhlan</h3>
                        <p>Mahasiswa</p>
                        <p>201810370311297</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4">
            <div class="card profile-card">
                <div class="profile-header">&nbsp;</div>
                <div class="profile-body">
                    <div class="image-area">
                        <img class="" src="{{ Storage::disk('public')->url('foto/badris.jpg') }}" width="120" height="120" />
                    </div>
                    <div class="content-area">
                        <h3>Muhammad Badris</h3>
                        <p>Mahasiswa</p>
                        <p>201810370311285</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4">
            <div class="card profile-card">
                <div class="profile-header">&nbsp;</div>
                <div class="profile-body">
                    <div class="image-area">
                        <img class="" src="{{ Storage::disk('public')->url('foto/iqbal.jpg') }}" width="120" height="120" />
                    </div>
                    <div class="content-area">
                        <h3>Muhammad Iqbal</h3>
                        <p>Mahasiswa</p>
                        <p>201810370311294</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-xs-12 col-sm-6">
            <div class="card profile-card">
                <div class="profile-header">&nbsp;</div>
                <div class="profile-body">
                    <div class="image-area">
                        <img class="" src="{{ Storage::disk('public')->url('foto/logo.png') }}" width="120" height="120" />
                    </div>
                    <div class="content-area">
                        <h3>Moch. Rizky</h3>
                        <p>Mahasiswa</p>
                        <p>201810370311293</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6">
            <div class="card profile-card">
                <div class="profile-header">&nbsp;</div>
                <div class="profile-body">
                    <div class="image-area">
                        <img class="" src="{{ Storage::disk('public')->url('foto/jadid.jpg') }}" width="120" height="120" />
                    </div>
                    <div class="content-area">
                        <h3>Jadid</h3>
                        <p>Mahasiswa</p>
                        <p>201810370311283</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')

@endpush
