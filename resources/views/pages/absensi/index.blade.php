@extends('layouts.app')

@section('title', 'Attendances')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Attendances</h1>
                {{-- <div class="section-header-button">
                    <a href="{{ route('attendances.create') }}" class="btn btn-primary">Add New</a>
                </div> --}}
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Attendances</a></div>
                    <div class="breadcrumb-item">All Attendances</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    {{-- <div class="col-12">
                        @include('layouts.alert')
                    </div> --}}
                </div>
                <h2 class="section-title">Attendances</h2>
                <p class="section-lead">
                    You can manage all Attendances, such as editing, deleting and more.
                </p>


                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Posts</h4>
                            </div>
                            <div class="card-body">

                                <div class="float-right">
                                    <form method="GET" action="{{ route('attendances.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search by patient name" name="name">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>

                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Time In</th>
                                            <th>Time Out</th>
                                            <th>Latlong In</th>
                                            <th>Latlong Out</th>

                                            <th>Action</th>
                                        </tr>
                                        @foreach ($attendances as $attendance)
                                            <tr>

                                                <td>{{ $attendance->user->name }}
                                                </td>
                                                <td>
                                                    {{ $attendance->date }}
                                                </td>
                                                <td>
                                                    {{ $attendance->time_in }}
                                                </td>
                                                <td>
                                                    {{ $attendance->time_out }}
                                                </td>
                                                <td>
                                                    {{ $attendance->latlon_in }}
                                                </td>
                                                <td>
                                                    {{ $attendance->latlon_out }}
                                                </td>

                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='{{ route('attendances.edit', $attendance->id) }}'
                                                            class="btn btn-sm btn-info btn-icon">
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </a>

                                                        <form action="{{ route('attendances.destroy', $attendance->id) }}"
                                                            method="POST" class="ml-2">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}" />
                                                            <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                <i class="fas fa-times"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $attendances->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
