@extends('layouts.base')

@section('content')
<div class="container p-4">
<div class="row justify-content-center">
<div class="col-12 col-md-8 col-lg-6 col-xl-5">
<div class="card shadow-sm" style="border-radius: 1rem;">
<div class="card-body p-5">

@yield('box-content')

</div>
</div>
</div>
</div>
</div>
@endsection