@extends('layout.master')
@section('content')

    <body>
        <div class="hero-cover" role="img" aria-label="Scenic mountain cover image"></div>
        <div class="container">
            <div class="profile-bar mt-n5">
                <div class="avatar">
                    <img src="{{ asset('profile.jpeg') }}" alt="Avatar">
                </div>

                <div class="profile-meta">
                    <h2>{{ $user->username }}</h2>
                    <div class="sub">
                        <div><i class="bi bi-geo-alt"></i> Saint Santos, Jakarta</div>
                        <div><i class="bi bi-facebook"></i> leb_sunshine</div>
                    </div>
                </div>

                <div class="profile-actions">
                    <button class="dots-btn" aria-label="more"><i class="bi bi-three-dots"></i></button>
                </div>
            </div>
        </div>

        <div class="info-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 contact-list">
                        <div class="contact-item">
                            <i class="bi bi-telephone"></i>
                            <div>+62 813 3856 1122</div>
                        </div>

                        <div class="contact-item">
                            <i class="bi bi-envelope"></i>
                            <div>{{ $user->email }}</div>
                        </div>

                        <a href="{{ route('route.profile.history', $user->id) }}" class="btn-history">History</a>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('styles')
        <style>
            :root {
                --teal: #0f6b67;
                --teal-dark: #0b5a56;
                --muted-pink: #efe6e7;
            }

            .profile-bar {
                background: #fff;
                padding: 28px 40px;
                box-shadow: 0 1px 0 rgba(0, 0, 0, 0.04);
                display: flex;
                align-items: center;
                gap: 28px;
                position: relative;
            }

            .avatar {
                width: 180px;
                height: 180px;
                border-radius: 50%;
                overflow: hidden;
                flex: 0 0 180px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.16);
                border: 8px solid #fff;
                margin-top: -90px;
                background: #fff;
            }

            .avatar img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
            }

            .profile-meta {
                flex: 1;
            }

            .profile-meta h2 {
                margin: 0;
                font-size: 28px;
                font-weight: 800;
                letter-spacing: 0.2px;
            }

            .profile-meta .sub {
                margin-top: 8px;
                color: #666;
                display: flex;
                gap: 18px;
                align-items: center;
                font-size: 14px;
            }

            .profile-meta .sub i {
                font-size: 16px;
                color: #111;
                margin-right: 8px;
            }

            .profile-actions {
                flex: 0 0 80px;
                text-align: right;
            }

            .dots-btn {
                width: 42px;
                height: 42px;
                border-radius: 50%;
                border: 1px solid #eee;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background: #fff;
            }

            .info-wrap {
                background: var(--muted-pink);
                padding: 56px 80px;
            }

            .contact-list {
                max-width: 540px;
            }

            .contact-item {
                display: flex;
                align-items: center;
                gap: 14px;
                margin-bottom: 18px;
                color: #111;
            }

            .contact-item i {
                font-size: 20px;
                color: #111;
                width: 26px;
                text-align: center;
            }

            .btn-history {
                display: inline-block;
                background: var(--teal);
                color: #fff;
                border-radius: 40px;
                padding: 14px 36px;
                box-shadow: 0 10px 18px rgba(11, 90, 86, 0.18);
                font-weight: 700;
                margin-top: 18px;
                text-decoration: none;
            }

            .hero-cover {
                width: 100%;
                height: 220px;
                background-image: url('/cover.jpg');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                display: block;
                border-bottom: 1px solid rgba(0, 0, 0, 0.04);
                box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.02);
            }

            /* Responsive
            @media (max-width:768px){
                .profile-bar { padding:18px; gap:14px; flex-direction:column; align-items:flex-start; }
                .profile-actions { align-self:flex-end; width:100%; text-align:right; }
                .avatar { margin-top:-60px; width:110px; height:110px; flex:0 0 110px; }
                .info-wrap { padding:36px 18px; }
            } */
        </style>
    @endpush
