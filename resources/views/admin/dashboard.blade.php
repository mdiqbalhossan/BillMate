@extends('layouts.app')

@section('title', 'Admin Dashboard')

@push('css')

@endpush

@section('content')
    <div class="container-fluid">
        <div class="social-dash-wrap">
            @include('layouts.partials.breadcrumb')
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="color-dark fw-500 fs-20 mb-0">Skeleton Page</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

@endpush
