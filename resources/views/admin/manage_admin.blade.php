@extends('admin/layout.template')

@section('content')

    <!-- Main Content -->
    <div class="main-content">
      <section class="section">
        <div class="section-header">
          <h1>Management Admin</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Admin</a></div>
            <div class="breadcrumb-item">Management Admin</div>
          </div>
        </div>

        <div class="section-body">
          <div class="d-flex justify-content-start mb-3">
            <a class="btn btn-lg btn-primary" href="{{ url('adm/admin-management/add') }}"><i class="fas fa-user-plus mr-1"></i> Tambah Admin</a>
          </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                    <tr>
                                        <th class="text-center">
                                            No.
                                        </th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Jenis Kelamin</th>
                                        <th>No. WA</th>
                                        <th>Alamat</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->gender }}</td>
                                            <td>{{ $item->whatsapp }}</td>
                                            <td>{{ $item->address }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ url('/adm/admin-management/edit').'/'.$item->user_id }}"
                                                       class="btn btn-info mr-2">Edit</a><a
                                                        href="{{ url('/delete-admin').'/'.$item->user_id }}"
                                                        class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
      </section>
    </div>

@endsection
