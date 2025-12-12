@extends('layouts.master')

@section('content')
<style>
    body {
        background-color: #f8f8f8;
    }

    .profile-container {
        width: 90%;
        margin: 40px auto 80px auto;
        display: flex;
        gap: 40px;
    }

    .sidebar {
        width: 250px;
        background-color: #ffffff;
        border-radius: 10px;
        padding: 30px 20px;
        box-shadow: 0px 2px 6px rgba(0,0,0,0.1);
        height: fit-content;
    }

    .sidebar .menu-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 12px 0;
        cursor: pointer;
    }

    .sidebar .menu-item:hover {
        opacity: 0.7;
    }

    .profile-card {
        flex: 1;
        background-color: #ffffff;
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0px 2px 6px rgba(0,0,0,0.1);
    }

    .profile-card hr {
        margin: 0 30px;
        border: none;
        border-left: 1px solid #dcdcdc;
        height: 100%;
    }

    .profile-content {
        display: grid;
        grid-template-columns: 1.2fr 0.1fr 1fr;
        gap: 30px;
    }

    .profile-input label {
        font-weight: 600;
        margin-bottom: 5px;
        display: block;
    }

    .profile-input input,
    .profile-input textarea {
        width: 100%;
        padding: 10px 12px;
        border-radius: 6px;
        border: 1px solid #ccc;
        outline: none;
    }

    .profile-input textarea {
        height: 100px;
        resize: none;
    }

    .image-section {
        text-align: center;
    }

    .image-preview {
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background-color: #dcdcdc;
        margin: 0 auto 20px auto;
    }

    .upload-btn {
        border: 1px solid #000;
        padding: 8px 20px;
        border-radius: 6px;
        background: #fff;
        cursor: pointer;
    }

    .save-btn {
        padding: 8px 20px;
        background: #eee;
        border-radius: 6px;
        border: 1px solid #999;
    }
</style>

<div class="profile-container">
    
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="menu-item">
            <span>👤</span> <span>Nama Toko</span>
        </div>
        <div class="menu-item">
            <span>📜</span> <span>Riwayat Pesanan</span>
        </div>
        <div class="menu-item">
            <span>🔒</span> <span>Ubah Password</span>
        </div>
    </div>

    <!-- Content -->
    <div class="profile-card">
        <h3 style="margin-bottom: 30px; font-size: 22px;">Profil Akun</h3>

        <div class="profile-content">

            <!-- Left Form -->
            <div class="profile-input">
                <label>Nama Toko:</label>
                <input type="text" placeholder="Sample Nama">

                <label style="margin-top: 15px;">Kontak:</label>
                <input type="text" placeholder="081234567803">

                <label style="margin-top: 15px;">Waktu Pembukaan:</label>
                <div style="display: flex; gap: 10px;">
                    <input type="time">
                    <span style="margin-top: 8px;">Sampai</span>
                    <input type="time">
                </div>

                <label style="margin-top: 15px;">Alamat Toko:</label>
                <textarea placeholder="Contoh Alamat jl ahmad no 112"></textarea>

                <button class="save-btn" style="margin-top: 20px;">Save Changes</button>
            </div>

            <hr>

            <!-- Image Upload -->
            <div class="image-section">
                <div class="image-preview"></div>

                <button class="upload-btn">Pilih Foto</button>

                <p style="margin-top: 10px; font-size: 13px; color: #555;">
                    Ukuran maksimum 1MB <br>
                    Format Gambar: .JPG .JPEG .PNG
                </p>
            </div>

        </div>
    </div>

</div>

@endsection
