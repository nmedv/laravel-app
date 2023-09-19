

<div class="accordion m-3 p-2" id="accordionExample">
	<div class="accordion-item">
		<h2 class="accordion-header" id="headingOne">
			<button
				class="accordion-button collapsed"
				type="button"
				data-bs-toggle="collapse"
				data-bs-target="#collapseOne"
				aria-expanded="true"
				aria-controls="collapseOne"
			>Добавить запись</button>
		</h2>
		<div
			id="collapseOne"
			class="accordion-collapse collapse"
			aria-labelledby="headingOne"
			data-mdb-parent="#accordionExample"
		>
			<div class="accordion-body">
				@include('components.messages')

				<form action="{{ route('dbpost') }}" method="post">
				@csrf
					<div class="row mb-3">
						<div class="col">
							<div class="form-floating">
							<input class="form-control"
								id="inp-db-1"
								type="text"
								name="firstname"
								placeholder="firstname"
							/>
							<label for="inp-db-1">Имя</label>
							</div>
						</div>
						<div class="col">
							<div class="form-floating">
							<input class="form-control"
								id="inp-db-2"
								type="date"
								name="dob"
								placeholder="Date of birth"
							/>
							<label for="inp-db-2">Дата рождения</label>
							</div>
						</div>
						<div class="col">
						<button type="submit" class="btn btn-primary">Добавить</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<section class="d-flex m-3 p-2 align-content-center">
	<table class="table">
		<thead>
			<tr></tr>
		</thead>
		<tbody></tbody>
	</table>
</section>
	
</script>