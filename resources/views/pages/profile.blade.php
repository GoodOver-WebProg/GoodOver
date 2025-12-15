@extends('layout.master')
@section('content')

    <body>
        <div class="hero-cover" role="img" aria-label="Scenic mountain cover image"></div>
        <div class="container">
            <div class="profile-bar mt-n5">
                <div class="avatar">
                    <img src="{{ asset('profile.png') }}" alt="Avatar">
                </div>

                <div class="profile-meta">
                    <h2>{{ $user->username }}</h2>
                    <div class="sub">
                        <div>Created since {{$user->created_at->format('M d, Y')}}</div>
                    </div>
                </div>

                <div class="profile-actions">
                    <a href="{{ route('route.profile.edit', $user->id) }}" class="dots-btn" aria-label="Edit Profile">
                        <i class="bi bi-three-dots"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="info-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 contact-list">
                        <div class="contact-item">
                            <h4>Total order: {{ $totalOrders }}</h4>
                        </div>

                        <div class="contact-item">
                            <i class="bi bi-envelope"></i>
                            <div>{{ $user->email }}</div>
                        </div>

                        <a href="{{ route('route.profile.history', $user->id) }}" class="btn-history">{{ __('profile.history') }}</a>
                    </div>

                    <div class="col-md-6">
                        <h4>Recent Orders</h4>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" style="font-size: 0.95rem;">
                                <thead class="bg-light border-bottom">
                                    <tr class="text-muted text-uppercase d-none d-md-table-row" style="font-size: 0.8rem;">
                                        <th class="py-4 ps-4">{{ __('history.product_name') }}</th>
                                        <th class="py-4">{{ __('history.price') }}</th>
                                        <th class="py-4">{{ __('history.total_quantity') }}</th>
                                        <th class="py-4">{{ __('history.date') }}</th>
                                        <th class="py-4">{{ __('history.order_time') }}</th>
                                        <th class="py-4 text-end pe-4">{{ __('history.status') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $order)
                                        @php $firstItem = $order->items->first(); @endphp

                                        {{-- Desktop View --}}
                                        <tr class="d-none d-md-table-row clickable-row" role="button" tabindex="0" data-href="{{ route('order.status', $order->id) }}">
                                            <td class="ps-4 py-3 fw-medium">
                                                {{ $firstItem ? $firstItem->product->name : __('history.item_deleted') }}
                                            </td>
                                            <td class="py-3">
                                                Rp{{ number_format($firstItem ? $firstItem->unit_price : 0, 0, ',', '.') }}
                                            </td>
                                            <td class="py-3 text-muted">
                                                {{ $firstItem ? $firstItem->quantity : 0 }} {{ __('history.pcs') }}
                                            </td>
                                            <td class="py-3 text-muted">
                                                {{ $order->created_at->format('d F Y') }}
                                            </td>
                                            <td class="py-3 text-muted">
                                                {{ $order->created_at->format('H.i') }}
                                            </td>
                                            <td class="py-3 text-end pe-4">
                                                @php
                                                    $status = strtolower($order->status ?? 'pending');
                                                    $badgeClass = 'badge ';

                                                    switch($status) {
                                                        case 'pending':
                                                            $badgeClass .= 'bg-warning text-dark';
                                                            $badgeText = __('history.pending');
                                                            break;
                                                        case 'finished':
                                                            $badgeClass .= 'bg-success';
                                                            $badgeText = __('history.finished');
                                                            break;
                                                        case 'completed':
                                                            $badgeClass .= 'bg-success';
                                                            $badgeText = __('history.completed');
                                                            break;
                                                        case 'cancelled':
                                                            $badgeClass .= 'bg-danger';
                                                            $badgeText = __('history.cancelled');
                                                            break;
                                                        case 'canceled':
                                                            $badgeClass .= 'bg-danger';
                                                            $badgeText = __('history.canceled');
                                                            break;
                                                        default:
                                                            $badgeClass .= 'bg-secondary';
                                                            $badgeText = ucfirst($status);
                                                    }
                                                @endphp
                                                <span class="badge {{ $badgeClass }} px-3 py-2">
                                                    {{ $badgeText }}
                                                </span>
                                            </td>
                                        </tr>

                                        {{-- Mobile View --}}
                                        <tr class="d-md-none clickable-row" role="button" tabindex="0" data-href="{{ route('order.status', $order->id) }}">
                                            <td class="p-3">
                                                <div class="d-flex flex-column gap-2">
                                                    <div class="d-flex justify-content-between align-items-start">
                                                        <div class="flex-grow-1">
                                                            <div class="fw-bold mb-1" style="font-size: 0.95rem;">
                                                                {{ $firstItem ? $firstItem->product->name : __('history.item_deleted') }}
                                                            </div>
                                                            <div class="text-muted small">
                                                                {{ $order->created_at->format('d F Y') }} • {{ $order->created_at->format('H.i') }}
                                                            </div>
                                                        </div>
                                                        <div>
                                                            @php
                                                                $status = strtolower($order->status ?? 'pending');
                                                                $badgeClass = 'badge ';

                                                                switch($status) {
                                                                    case 'pending':
                                                                        $badgeClass .= 'bg-warning text-dark';
                                                                        $badgeText = __('history.pending');
                                                                        break;
                                                                    case 'finished':
                                                                        $badgeClass .= 'bg-success';
                                                                        $badgeText = __('history.finished');
                                                                        break;
                                                                    case 'completed':
                                                                        $badgeClass .= 'bg-success';
                                                                        $badgeText = __('history.completed');
                                                                        break;
                                                                    case 'cancelled':
                                                                        $badgeClass .= 'bg-danger';
                                                                        $badgeText = __('history.cancelled');
                                                                        break;
                                                                    case 'canceled':
                                                                        $badgeClass .= 'bg-danger';
                                                                        $badgeText = __('history.canceled');
                                                                        break;
                                                                    default:
                                                                        $badgeClass .= 'bg-secondary';
                                                                        $badgeText = ucfirst($status);
                                                                }
                                                            @endphp
                                                            <span class="badge {{ $badgeClass }} px-2 py-1" style="font-size: 0.75rem;">
                                                                {{ $badgeText }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                                                        <div>
                                                            <span class="text-muted small">{{ __('history.price') }}:</span>
                                                            <span class="fw-semibold ms-1">Rp{{ number_format($firstItem ? $firstItem->unit_price : 0, 0, ',', '.') }}</span>
                                                        </div>
                                                        <div>
                                                            <span class="text-muted small">{{ __('history.total_quantity') }}:</span>
                                                            <span class="fw-semibold ms-1">{{ $firstItem ? $firstItem->quantity : 0 }} {{ __('history.pcs') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-5 text-muted">
                                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                                {{ __('history.no_history') }}
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
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

            .btn-history:hover {
                color: #fff;
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

            @media (max-width: 991.98px) {
                .profile-bar {
                    padding: 20px;
                    gap: 20px;
                }

                .avatar {
                    width: 140px;
                    height: 140px;
                    flex: 0 0 140px;
                    margin-top: -70px;
                }

                .profile-meta h2 {
                    font-size: 24px;
                }

                .info-wrap {
                    padding: 40px 20px;
                }
            }

            @media (max-width: 767.98px) {
                .profile-bar {
                    padding: 18px;
                    gap: 14px;
                    flex-direction: column;
                    align-items: flex-start;
                }

                .profile-actions {
                    align-self: flex-end;
                    width: 100%;
                    text-align: right;
                }

                .avatar {
                    margin-top: -60px;
                    width: 110px;
                    height: 110px;
                    flex: 0 0 110px;
                }

                .profile-meta {
                    width: 100%;
                }

                .profile-meta h2 {
                    font-size: 20px;
                }

                .profile-meta .sub {
                    flex-direction: column;
                    gap: 8px;
                    align-items: flex-start;
                }

                .info-wrap {
                    padding: 36px 18px;
                }

                .contact-list {
                    max-width: 100%;
                }

                .btn-history {
                    width: 100%;
                    text-align: center;
                    padding: 12px 24px;
                }

                .hero-cover {
                    height: 180px;
                }
            }

            @media (max-width: 575.98px) {
                .profile-bar {
                    padding: 16px;
                }

                .avatar {
                    width: 100px;
                    height: 100px;
                    flex: 0 0 100px;
                    margin-top: -50px;
                }

                .profile-meta h2 {
                    font-size: 18px;
                }

                .info-wrap {
                    padding: 24px 16px;
                }

                .contact-item {
                    font-size: 14px;
                }

                .btn-history {
                    padding: 10px 20px;
                    font-size: 14px;
                }
            }
        </style>
    @endpush
