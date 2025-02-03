@extends('/layout')
@section('content')

<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container ">
                <div class="row justify-content-center">
                    <div class="col-lg-5 ">
                        <div class=" card shadow-lg border-0 rounded-lg mx-auto">
                            @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{session('error')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            <div class="card-header">
                                <h3 class="text-center font-weight-light my-3">Login</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{url('proses_login')}}" method="POST" id="logForm">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        @error('login_gagal')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <span class="alert-inner--text"><strong>Warning!</strong>  {{ $message }}</span>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            @enderror
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Username</label>
                                                <input type="text" name="username" class="form-control" id="exampleFormControlInput1">
                                            </div>
                                        @if($errors->has('username'))
                                        <span class="error">{{ $errors->first('username') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="exampleFormControlInput1">
                                        </div>
                                        @if($errors->has('password'))
                                        <span class="error">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <button class="btn w-100 btn-primary btn-block btn-login" type="submit">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
