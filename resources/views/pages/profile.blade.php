<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Profile</title>
    @include('layout.bootstrap')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
</head>
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

    <section class="info-wrap">
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

                    <a href="#" class="btn-history">History</a>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
