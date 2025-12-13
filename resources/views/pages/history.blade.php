@extends('layout.master')

@section('title', 'Activity History')

@section('content')
    <div class="container py-5">

        {{-- Header: Judul & Search Bar --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold m-0">
                <a href="{{ url()->previous() }}" class="text-dark text-decoration-none me-2">
                    <i class="bi bi-chevron-left"></i>
                </a>
                Activity History
            </h3>

            <div class="d-flex gap-2">
                {{-- Search Bar --}}
                <div class="input-group" style="width: 250px;">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control border-start-0 ps-0" placeholder="Search">
                </div>

                {{-- Sort Dropdown --}}
                <select class="form-select" style="width: 150px;">
                    <option selected>Newest</option>
                    <option value="1">Oldest</option>
                    <option value="2">Price</option>
                </select>
            </div>
        </div>

        {{-- Table Section --}}
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0" style="font-size: 0.95rem;">
                    <thead class="bg-light border-bottom">
                        <tr class="text-muted text-uppercase" style="font-size: 0.8rem;">
                            <th class="py-4 ps-4">Product Name</th>
                            <th class="py-4">Price</th>
                            <th class="py-4">Total Quantity</th>
                            <th class="py-4">Date</th>
                            <th class="py-4">Time</th>
                            <th class="py-4 text-end pe-4">Rated</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                {{-- Mengambil item pertama dari order --}}
                                @php $firstItem = $order->items->first(); @endphp

                                <td class="ps-4 py-3 fw-medium">
                                    {{-- Nama Produk (jika ada itemnya) --}}
                                    {{ $firstItem ? $firstItem->product->name : 'Item dihapus' }}
                                </td>
                                <td class="py-3">
                                    {{-- Harga dari tabel order_items --}}
                                    Rp{{ number_format($firstItem ? $firstItem->unit_price : 0, 0, ',', '.') }}
                                </td>
                                <td class="py-3 text-muted">
                                    {{-- Quantity --}}
                                    {{ $firstItem ? $firstItem->quantity : 0 }} pcs
                                </td>
                                 <td class="py-3 text-muted">
                            {{ $order->created_at->format('d F Y') }}
                        </td>
                        <td class="py-3 text-muted">
                            {{ $order->created_at->format('H.i') }}
                        </td>
                        <td class="py-3 text-end pe-4 text-muted">
                            <i class="bi bi-star"></i>
                            <i class="bi bi-star"></i>
                            <i class="bi bi-star"></i>
                            <i class="bi bi-star"></i>
                            <i class="bi bi-star"></i>
                        </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    Belum ada riwayat pemesanan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-between align-items-center mt-4 text-muted">
            <small>Showing page {{ $orders->currentPage() }} of {{ $orders->lastPage() }}</small>

            {{-- Custom Pagination Links --}}
            <div>
                {{ $orders->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Styling tambahan agar mirip gambar */
        .table thead th {
            font-weight: 500;
            letter-spacing: 0.5px;
            color: #adb5bd;
        }

        .form-control:focus,
        .form-select:focus {
            box-shadow: none;
            border-color: #dee2e6;
        }

        /* Menghilangkan border default table bootstrap agar lebih clean */
        .table> :not(caption)>*>* {
            border-bottom-color: #f1f3f5;
        }
    </style>
@endpush
