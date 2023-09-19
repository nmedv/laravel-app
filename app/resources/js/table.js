

export default class Table
{
	parentNode
	name
	form
	body
	inputCount

	constructor(name)
	{
		this.name = name;

		this.form = document.createElement("form");
		this.form.name = `form_${name}`;
		this.form.action = "http://localhost/db/post";
		this.form.method = "post";
		this.form.innerHTML = `
		<div class="d-flex justify-content-center">
			<div class="spinner-border text-primary" role="status">
				<span class="visually-hidden">Загрузка...</span>
			</div>
		</div>
		`

		this.body = document.createElement("table");
		this.body.id = `table-${this.name}`;
		this.body.className = "table";
		this.body.innerHTML = `
		<thead class="d-flex justify-content-center">
			<tr class="spinner-border text-primary"></tr>
		</thead>
		`

		this.parentNode = document.body;
	}


	draw(parentNode)
	{
		this.parentNode = parentNode;

		var elem = document.createElement("div");
		elem.className = "accordion m-4 shadow-sm";
		elem.id = `accordion-${this.name}`;
		elem.innerHTML = `
		<div class="accordion-item">
			<div class="accordion-body">
				<strong>Таблица: ${this.name}</strong>
			</div>
		</div>
		<div class="accordion-item">
			<h2 class="accordion-header" id="aheader-${this.name}">
				<button
					class="accordion-button collapsed"
					type="button"
					data-bs-toggle="collapse"
					data-bs-target="#collapse-${this.name}"
					aria-expanded="true"
					aria-controls="collapse-${this.name}"
				>
					Добавить запись
				</button>
			</h2>
			<div
				id="collapse-${this.name}"
				class="accordion-collapse collapse"
				aria-labelledby="aheader-${this.name}"
				data-bs-parent="#accordion-${this.name}"
			>
				<div class="accordion-body">
					${this.form.outerHTML}
				</div>
			</div>
		</div>
		<div class="accordion-item">
			<div class="accordion-body">
				${this.body.outerHTML}
			</div>
		</div>`;

		this.parentNode.appendChild(elem);
	}

	
	populateRecords(json)
	{
		var inp = `<div style='
			display: grid;
			grid-gap: 15px;
			grid-template-columns: repeat(auto-fit, 200px);
		'>`;
		var input_names = Object.keys(json.data[0]);
		var inp_i = 0;
		for (var col of json.colinfo) {
			if (col[2]) {
				inp += `
				<div class="form-floating">
					<input class="form-control"
						id="inp-${this.name}-${inp_i}"
						type="${col[1]}"
						name="${input_names[inp_i]}"
						placeholder="value"
					/>
					<label for="inp-${this.name}-${inp_i}">${col[0]}</label>
				</div>`;
			}
			inp_i++;
		}
		inp += `
			<button
				id='submit-${this.name}'
				type='submit'
				class='btn btn-primary'
			>
				Добавить
			</button>
		</div>`;
		document.forms[this.form.name].innerHTML = inp;

		var thead = "<thead>";
		for (var col of json.colinfo) {
			thead += `<th scope='col'>${col[0]}</th>`
		}
		thead += "</thead>";
		var tbody = "<tbody>";
		for (var row of json.data) {
			tbody += "<tr>"
			for (var cell in row) {
				tbody += `<td>${row[cell]}</td>`
			}
			tbody += "</tr>";
		}
		document.getElementById(this.body.id).innerHTML = thead + tbody;
	}


	setLoading(status)
	{
		for (var inp_i = 0; inp_i < this.inputCount; i++) {
			var inp = document.getElementById(`inp-${this.name}-${inp_i}`);
			inp.disabled = status;
		}

		var subm = document.getElementById(`submit-${this.name}`);
		subm.disabled = status;
		if (status) {
			subm.innerHTML = `
				<span
					class="spinner-border spinner-border-sm"
					role="status"
					aria-hidden="true">
				</span>
				<span">Добавить...</span>
			`;
		} else {
			subm.innerHTML = "Добавить";
		}	

	}
}

