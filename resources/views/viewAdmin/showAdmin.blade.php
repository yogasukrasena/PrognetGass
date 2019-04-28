@extends('viewAdmin.layout.app')
@section('title','Admin')
@section('content')

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Admin</strong>
        </div>
        <div class="card-body">
          <form action="{{ route('admin.form') }}">
            <button type="submit" class="btn btn-primary mr-2">+ Tambah</button>
          </form>
        </div>
        <div class="card-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">NO</th>
                  <th scope="col">Username</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Foto Profile</th>
                  <th scope="col">Phone</th>
                  <th scope="col">Edit</th>
                </tr>
              </thead>
              <tbody>
              @foreach($tampilAdmin as $data)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $data->username }}</td>
                  <td>{{ $data->name }}</td>
                  <td><img class="user-avatar rounded-circle" src="{{ asset('images/fotoProfile/'.$data->profile_image) }}" alt="image"></td>
                  <td>{{ $data->phone }}</td>
                  <td class="actions">
                    <a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>
                    <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                     <i class="fa fa-calendar-o"></i>
                  </td>
              @endforeach
                </tr>
            </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
