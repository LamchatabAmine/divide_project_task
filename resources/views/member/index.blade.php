@extends('layouts.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('success') }}.
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('error') }}.
                </div>
            @endif
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Memebers</h1>
                </div>
                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <a href=" {{ route('member.create') }} " class="btn btn-sm btn-primary">Ajouter Memeber</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header col-md-12">
                            <div class="d-flex justify-content-end align-items-center  p-0">
                                <div class="input-group input-group-sm col-md-3 p-0">
                                    <input id="searchMember" type="text" name="table_search"
                                        class="form-control float-right" placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body table-responsive p-0 table-member">
                            @include('member.table')
                        </div>
                        <div class="d-flex justify-content-between align-items-center p-2">
                            <div class="d-flex align-items-center">
                                {{-- @can('create', App\Models\Member::class) --}}
                                <form action="{{ route('member.import') }}" method="post" enctype="multipart/form-data"
                                    id="importForm">
                                    @csrf
                                    <label for="upload" class="btn btn-default btn-sm mb-0 font-weight-normal">
                                        <i class="fa-solid fa-file-arrow-down"></i>
                                        {{ __('IMPORTER') }}
                                    </label>
                                    <input type="file" id="upload" name="file" style="display:none;"
                                        onchange="submitForm()" />
                                </form>
                                {{-- @endcan --}}
                                <a href="{{ route('member.export') }}" class="btn  btn-default btn-sm mt-0 mx-2">
                                    <i class="fa-solid fa-file-export"></i>
                                    {{ __('EXPORTER') }}
                                </a>
                            </div>
                            <div class="">
                                <ul class="pagination  m-0 float-right">
                                    {{ $members->links() }}
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
