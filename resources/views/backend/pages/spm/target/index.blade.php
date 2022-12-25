@extends('backend.layouts.main')

@section('container')
    <div class="container">
        @include('backend.partials.breadcrumb')

        @role('Superadmin|Administrator|Peninjau')
            @include('backend.pages.spm.target.roles.admin', ['data' => $data])
        @else
            @include('backend.pages.spm.target.roles.user', ['data' => $data])
        @endrole
    </div>
@endsection
