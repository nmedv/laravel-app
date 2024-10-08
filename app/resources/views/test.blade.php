@extends('layouts.base')

@section('content')


<div class="container">
	<div class="row justify-content-center">
	<div class="col-12 col-md-8 col-lg-6 col-xl-5">
		<div class="card" style="border-radius: 1rem;">
		<div class="card-body p-5 text-center">

			<div class="my-md-5 pb-5">

			<h1 class="fw-bold mb-0">Welcome</h1>

			<i class="fas fa-user-astronaut fa-3x my-5"></i>

			<div class="form-outline mb-4">
				<input type="email" id="typeEmail" class="form-control form-control-lg" />
				<label class="form-label" for="typeEmail">Email</label>
			</div>

			<div class="form-outline mb-5">
				<input type="password" id="typePassword" class="form-control form-control-lg" />
				<label class="form-label" for="typePassword">Password</label>
			</div>

			<button class="btn btn-primary btn-lg btn-rounded gradient-custom text-body px-5" type="submit">Login</button>

			</div>

			<div>
			<p class="mb-0">Don't have an account? <a href="#!" class="text-body fw-bold">Sign Up</a></p>
			</div>

		</div>
		</div>
	</div>
	</div>
</div>

@endsection