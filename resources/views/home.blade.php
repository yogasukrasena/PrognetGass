@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if ( Auth::user()->status != 1 )
                <form method="GET" action="{{ route('user.logout') }}">
                    <div class="card-header">Dashboard</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-warning" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            Silakan verifikasi akun anda terlebih dahulu <button type="submit" class="btn-primary">Back</button>
                        </div>
                    </div>
                </form>
                @else
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    <form>
                        <input type="text" name="namaUser" value="{{ Auth::user()->name }}"><br>
                        <input type="email" name="email" value="{{ Auth::user()->email }}"><br>
                        <input type="file" multiple name="image" value="{{ Auth::user()->profile_image }}">
                    </form>
                    
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
