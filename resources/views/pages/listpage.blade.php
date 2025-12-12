@extends('layout.master')

@section('title', 'ListProduct - GoodOver')

@section('content')
<section class='container min-vh-100 position-relative'>
    <div class="row">
        <div class="col col-2 d-flex flex-column align-items-baseline">
            <div class="d-flex justify-content-center align-content-center mt-5">
                <i class="bi bi-funnel align-self-center fw-bold"></i>
                <h3 class="p-0 m-0 fw-bold">
                    Filter
                </h3>
            </div>
            {{-- Filter --}}
            @php
            $search = request()->route('search');
            @endphp
            <form action="{{ route('route.product',['search' => $search]) }}" method="GET">

                <input type="hidden" name="sort" value="{{ request('sort','price_asc') }}">

                @foreach ($filterHeader as $filterKey => $filter)
                <div class="d-flex flex-column justify-content-center align-content-center mt-4">

                    <h5 class="p-0 m-0 fw-bold">{{ $filter['label'] }}</h5>
                    
                    @php $selected = request("filters.$filterKey", []); @endphp

                    @foreach ($filter['options'] as $opt)
                    <div class="form-check mt-2">
                        <input 
                            class="form-check-input"
                            type="checkbox" 
                            name="filters[{{ $filterKey }}][]" 
                            value="{{ $opt['value'] }}" 
                            @if(in_array($opt['value'], $selected)) checked @endif
                        >
                        <label>
                            {{ $opt['label'] }}
                        </label>
                    </div>
                    @endforeach
                </div>
                @endforeach
                <button type="submit" class="btn mt-2 text-light" style="background-color: #086D71;">
                    {{ __('filters.submit') }}
                </button>
            </form>
        </div>
        <div class="col col-10 min-vh-100 ">
            <div class="mt-4 h-100">
                <div class="px-5 py-4 border border-black rounded-2">
                    <div class="mb-2 d-flex justify-content-between  align-items-center  ">
                        <div>
                            {{ __('filters.search') }}
                        </div>
                        {{-- sort --}}
                        <div class="d-flex align-items-center">
                            <div class="me-2">Sort:</div>
                        
                            <form action="{{ route('route.product') }}" method="GET">
                                @php
                                $sort = request('sort', 'price_asc');
                                @endphp
                                
                                <input type="hidden" name="search" value="{{ $search }}">
                        
                                @foreach (request('filters', []) as $filterBy => $values)
                                    @foreach ($values as $val)
                                    <input type="hidden" name="filters[{{ $filterBy }}][]" value="{{ $val }}">
                                    @endforeach
                                @endforeach
                        
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        {{ $sort === 'price_desc' ? 
                                            __('sort.label.price') . ": ". __('sort.price.descending')
                                            : __('sort.label.price') . ": ". __('sort.price.ascending') 
                                        }}
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <button class="dropdown-item" type="submit" name="sort" value="price_asc">
                                                {{__('sort.label.price') . ": ". __('sort.price.ascending') }}
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item" type="submit" name="sort" value="price_desc">
                                                {{__('sort.label.price') . ": ". __('sort.price.descending')}}
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
                        @foreach ($products as $product)
                        <div class="col">
                            {{-- <a href="{{ route('', $product->id) }}" class="text-decoration-none text-dark"> --}}
                                <div class="card h-100 border-0 shadow-sm">
                                    <img src="{{ $product->image_path ? asset($product->image_path) : asset('images/burger.jpg') }}"
                                        class="card-img-top object-fit-cover" style="height: 180px;"
                                        alt="{{ $product->name }}">

                                    <div class="card-body p-2">
                                        <h6 class="card-title mb-1 text-truncate">
                                            {{ $product->name }}
                                        </h6>

                                        <p class="mb-1 fw-semibold text-success">
                                            Rp{{ number_format($product->price, 0, ',', '.') }}
                                        </p>

                                        <p class="mb-0 small text-muted text-truncate">
                                            {{ $product->store->name ?? 'Store name' }}
                                        </p>

                                        <p class="mb-0 small text-muted">
                                            Stock: {{ $product->total_quantity }}
                                        </p>
                                    </div>
                                </div>
                            {{-- </a> --}}
                        </div>
                        @endforeach
                    </div>
                    {{-- <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
                        <div class="col">
                            <a href="#" class="text-decoration-none text-dark">
                                <div class="card h-100 border-0 shadow-sm">
                                    <img src="{{ asset('images/burger.jpg') }}" class="card-img-top object-fit-cover"
                                        style="height: 180px;" alt="Product Name">

                                    <div class="card-body p-2">
                                        <h6 class="card-title mb-1 text-truncate">
                                            Placeholder Product Name
                                        </h6>

                                        <p class="mb-1 fw-semibold text-success">
                                            Rp10.000
                                        </p>

                                        <p class="mb-0 small text-muted text-truncate">
                                            Placeholder Store Name
                                        </p>

                                        <p class="mb-0 small text-muted">
                                            Stock: 99
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection