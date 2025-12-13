@extends('layout.master')

@section('content')
<div class="container mt-4 mb-5">

    <div class="p-4" style="background: #f1f1f1; border-radius: 20px;">
        <div class="row">

            {{-- LEFT SIDE FORM --}}
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Food Name --}}
                <label class="fw-semibold mb-1">
                    <span class="text-danger">*</span> Insert Food Name
                </label>
                <input type="text" name="name" class="form-control mb-3">

                {{-- Price + Add-on --}}
                <div class="row">
                    <div class="col-md-6">
                        <label class="mb-1">Insert Food Price</label>
                        <input type="number" name="price" class="form-control mb-3">
                    </div>

                    <div class="col-md-6">
                        <label class="mb-1">Insert Food Add-on</label>
                        <input type="text" name="addon" class="form-control mb-3">
                    </div>
                </div>

                {{-- Description --}}
                <label class="fw-semibold mb-1">
                    <span class="text-danger">*</span> Insert Food Description
                </label>
                <textarea name="description" class="form-control mb-4" rows="5"></textarea>

                <button class="btn btn-outline-dark px-4">Save Changes</button>
            </form>


            {{-- RIGHT SIDE IMAGE UPLOAD --}}
            <div class="col-md-4 d-flex justify-content-center align-items-center">
                <div 
                    class="border border-2 border-secondary d-flex flex-column justify-content-center align-items-center"
                    style="width: 100%; height: 350px; border-style: dashed !important; border-radius: 15px;"
                >
                    
                    <div class="text-center">
                        <i class="bi bi-upload" style="font-size: 45px;"></i>
                        <p class="mt-2 fw-semibold">Drop Image Here</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

{{-- FOOTER --}}
<footer class="text-center py-3 mt-5 fixed-bottom">
    © 2025 GoodOver. All rights reserved.
</footer>

@endsection
