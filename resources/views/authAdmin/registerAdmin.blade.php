@extends('viewAdmin.layout.app')
@section('title','input Produk')
@section('content')

<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Input Produk</h4>
                  <p class="card-description">
                  </p>
                  <form class="forms-sample"  method="POST" action="{{ route('admin.register') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      @if (session('alert'))
                        <div class="alert alert-success">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <strong>Sukses!!!</strong> {{ session('alert') }} <a href="" class="alert-link">Lanjutkan</a>.
                        </div>
                      @endif
                    <div class="form-group">
                      <label for="exampleInputName1">Username</label>
                      <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
                          @if ($errors->has('username'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('username') }}</strong>
                              </span>
                         @endif
                    </div>
                    <div class="form-group">  
                      <label for="exampleInputEmail3">Nama</label>
                      <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                         @if ($errors->has('name'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('name') }}</strong>
                              </span>
                         @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Phone</label>
                      <input id="phone" type="number" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required>
                         @if ($errors->has('phone'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                         @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Password</label>
                      <input id="password" type="password" class="form-control  {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                          @if ($errors->has('password'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('password') }}</strong>
                              </span>
                          @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Password Confirm</label>
                      <input id="password-confirm" type="password" class="form-control  " name="password_confirmation" required>
                    </div>
                    <div class="form-group">
                      <label>Foto Profile</label>
                      <input type="file" name="profileimage" class="file-upload-default" multiple="multiple">
                      <div class="input-group col-xs-12">
                        <input type="file" class="form-control file-upload-info" placeholder="Upload Image" multiple="multiple" name="profileimage">
                        <span class="input-group-append">
                          <a href="#" class="file-upload-browse btn btn-info" type="button" data-dismiss="">Remove</a>
                        </span>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div> 
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection