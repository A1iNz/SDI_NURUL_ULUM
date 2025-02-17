@extends('layout.layout')
@section('content')
<div class="bg-secondary">
    <div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
          <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
            <span class="fs-4">SDI Nurul Ulum</span>
          </a>

          <ul class="nav nav-pills">
            <li class="nav-item"><a href="{{ url('/admin') }}" class="nav-link active" aria-current="page">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Features</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Pricing</a></li>
            <li class="nav-item"><a href="#" class="nav-link">FAQs</a></li>
            <li class="nav-item"><a href="#" class="nav-link">About</a></li>
          </ul>
        </header>
    </div>
</div>
<div class="container">
    <div id="layoutSidenav_content">
        <main>
            <div class="container ">
                <div class="row justify-content-center align-content-center" style="height: 600px">
                    <div class="card btn bg-primary p-5 m-5 col-xl-3" style="height: 200px">
                        <a href="{{ url('absensi') }}" class="my-auto text-decoration-none text-white"><h3>Absensi</h3></a>
                    </div>
                    <div class="card btn bg-primary py-5 m-5 col-xl-3">
                        <a href="{{ url('pembayaran') }}" class="my-auto text-decoration-none text-white"><h3>Pembayaran</h3></a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>


@endsection
