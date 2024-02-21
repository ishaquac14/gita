@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <h3 class="mt-4">Barang Keluar</h3>
        <ol class="breadcrumb mb-5">
            <li class="breadcrumb-item active">Outgoing Item Report</li>
        </ol>

        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif

        @if (Session::has('warning'))
            <div class="alert alert-warning" role="alert">
                {{ Session::get('warning') }}
            </div>
        @endif

        @if (Session::has('danger'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('danger') }}
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-header">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#myModal">
                    <i class="fa-solid fa-plus"></i> Tambah
                </button>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>ID Perangkat</th>
                            <th>Pengambil</th>
                            <th>Qty</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($keluars as $keluar)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $keluar->tanggal }}</td>
                                <td>{{ $keluar->id_barang }}</td>
                                <td>{{ $keluar->pengambil }}</td>
                                <td>{{ $keluar->qty }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editModal">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#destroyModal">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Barang Keluar</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form method="POST" action="{{ route('keluar.store') }}">
                        @csrf
                        <div class="mt-3">
                            <input type="date" name="tanggal" class="form-control">
                        </div>
                        <div class="mt-3">
                            <select name="id_barang" class="form-control">
                                <option selected disabled>-- Pilih Barang --</option>
                                @foreach ($stocks as $stock)
                                    <option value="{{ $stock->id }}">{{ $stock->id_device }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-3">
                            <input type="text" name="pengambil" class="form-control" placeholder="Pengambil">
                        </div>
                        <div class="mt-3">
                            <input type="number" name="qty" class="form-control" placeholder="Qty">
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal Edit -->
    @foreach ($keluars as $keluar)
        <div class="modal fade" id="editModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Barang</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form method="POST" action="{{ route('keluar.update', ['id' => $keluar->id]) }}">
                            @method('PUT')
                            @csrf
                            <div class="mt-3">
                                <input type="date" name="tanggal" class="form-control" value="{{ $keluar->tanggal }}">
                            </div>
                            <div class="mt-3">
                                <select name="id_barang" class="form-control" readonly>
                                    @foreach ($stocks as $stock)
                                        <option value="{{ $stock->id }}">{{ $stock->id_device }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-3">
                                <input type="text" name="pengambil" class="form-control"
                                    value="{{ $keluar->pengambil }}">
                            </div>
                            <div class="mt-3">
                                <input type="number" name="qty" class="form-control" value="{{ $keluar->qty }}">
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-warning">Update</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- The Modal Destroy -->
    @foreach ($keluars as $keluar)
        <div class="modal fade" id="destroyModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Hapus Barang</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form method="GET" action="{{ route('keluar.destroy', ['id' => $keluar->id]) }}">
                            @method('DELETE')
                            @csrf

                            <div class="align-middle">
                                <p>Are you sure?</p>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">Delete</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
