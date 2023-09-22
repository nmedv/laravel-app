

class TableRowToolbar
{
	element

	constructor(name)
	{
		this.element = document.createElement("td");
		this.element.innerHTML = `
		<button
			class="btn btn-light"
			type="button"
			id="row-toolbar-btn-table-${name}"
			data-bs-toggle="dropdown"
			aria-expanded="false"
		>
			\u2807
		</button>
		<ul class="dropdown-menu" aria-labelledby="row-toolbar-btn-table-${name}">
			<button class='dropdown-item btn btn-light'>Изменить</button>
			<button class='dropdown-item btn btn-light text-danger'>Удалить</button>
		</ul>`;
	}
}


class Table
{
	name
	element
	loadScreen
	thead
	tbody

	constructor(name)
	{
		this.name = name;

		this.element = document.createElement("div");
		this.element.id = `table-${this.name}`;
		this.element.style.position = "relative";
		this.element.innerHTML = `
		<div
			style='
				display: none;
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				background-color: rgba(255, 255, 255, 0.5);'
			>
			<div
				class="d-flex justify-content-center align-items-center text-primary mt-2"
				style="width: 100%; height: 100%"
			>
				<div class="spinner-border" role="status"></div>
			</div>
		</div>
		<table class='table'>
			<thead></thead>
			<tbody></tbody>
		</table>`;
	}


	init()
	{
		this.element = document.getElementById(this.element.id);
		this.loadScreen = this.element.firstElementChild;
		this.thead = this.element.lastElementChild.firstElementChild;
		this.tbody = this.element.lastElementChild.lastElementChild;
	}

	
	setData(data, columns)
	{		
		this.thead.innerHTML = this.#generateThead(columns);
		this.updateData(data);
	}


	updateData(data)
	{
		this.tbody.innerHTML = this.#generateTbody(data);
	}


	#generateThead(columns)
	{
		var thead = "";
		for (var col of columns) {
			thead += `<th scope='col'>${col}</th>`;
		}
		thead += `<th scope='col' style='width: 1rem'></th>`;
		return thead;
	}


	#generateTbody(data)
	{
		var toolbar;
		var i = 0;
		var tbody = "";
		for (var row of data) {
			tbody += "<tr class ='align-middle'>";
			for (var cell of row) {
				tbody += `<td>${cell}</td>`;
			}
			toolbar = new TableRowToolbar(`${this.name}-${i++}`);
			tbody += `${toolbar.element.outerHTML}</tr>`;
		}

		return tbody;
	}


	setLoading(status)
	{
		if (status) {
			this.loadScreen.style.display = "block";
		} else {
			this.loadScreen.style.display = "none";
		}
	}
}


class TableEditorForm
{
	name
	element
	inputCount = 0
	body
	#hasSubmit = false
	#submitValue

	constructor(name)
	{
		this.name = name;

		this.body = document.createElement("div")
		this.body.id = `form-grid-${this.name}`;
		this.body.innerHTML = `
		<div class="d-flex justify-content-center">
			<div class="spinner-border text-primary" role="status">
			</div>
		</div>`;

		this.element = document.createElement("form");
		this.element.id = `form-${this.name}`;
		this.element.method = "post";
		this.element.appendChild(this.body);
	}


	init()
	{
		this.element = document.getElementById(this.element.id);
		this.body = document.getElementById(this.body.id);
	}


	addField(name, placeholder, type)
	{
		var inp;

		if (!this.inputCount) {
			this.body.innerHTML = "";
			this.body.style = `
			display: grid;
			grid-gap: 15px;
			grid-template-columns: repeat(auto-fit, 200px)`;
		}

		if (type == "submit" && !this.#hasSubmit) {
			inp = document.createElement("button");
			inp.className = "btn btn-primary";
			inp.id = `submit-${this.name}`;
			inp.type = type;
			inp.innerHTML = placeholder;
			this.#hasSubmit = true;
			this.#submitValue = placeholder;
		} else {
			inp = document.createElement("div");
			inp.className = "form-floating";
			inp.innerHTML = `
			<input class="form-control"
				id="inp-${this.name}-${this.inputCount}"
				type="${type}"
				name="${name}"
				placeholder="value"
			/>
			<label for="inp-${this.name}-${this.inputCount}">${placeholder}</label>`;

			this.inputCount++;
		}
		
		this.body.appendChild(inp);
	}


	setLoading(status)
	{
		// for (var i = 0; i < this.inputCount; i++) {
		// 	var inp = document.getElementById(`inp-${this.name}-${i}`);
		for (var inp of this.element.getElementsByTagName("input")) {
			inp.readOnly = status;
			if (!status) {
				inp.value = "";
			}
		}

		// var subm = document.getElementById(`submit-${this.name}`);
		var subm = this.element.getElementsByTagName("button")[0];
		subm.disabled = status;
		if (status) {
			subm.innerHTML = `
				<span
					class="spinner-border spinner-border-sm"
					role="status"
					aria-hidden="true">
				</span>
				<span">${this.#submitValue}</span>
			`;
		} else {
			subm.innerHTML = this.#submitValue;
		}	
	}


	async sendData(url, csrf)
	{
		const response = await fetch(url, {
			method: 'POST',
			headers: {
				"X-CSRF-TOKEN": csrf
			},
			body: new URLSearchParams((new FormData(this.element)).entries())
		});
	
		return response;
	}

	
	validateFields()
	{
		var result = true;
		var fields = this.element.lastElementChild.getElementsByClassName("form-floating");
		for (var field of fields) {
			var value = field.firstElementChild.value;
			if (!value) {
				result = false;
				this.setFieldInvalid(field, "Введите значение");
			} else {
				this.setFieldValid(field);
			}
		}

		return result;
	}

	setFieldInvalid(field, message)
	{
		var span = field.getElementsByClassName("text-danger")[0];
		if (!span) {
			var span = document.createElement("span");
			span.className = "text-danger";
			field.append(span);
			field.firstElementChild.className = "form-control border-danger";
		}

		span.innerHTML = message;
	}

	setFieldValid(field)
	{
		var span = field.getElementsByClassName("text-danger")[0];
		if (span) {
			span.remove();
			field.firstElementChild.className = "form-control";
		}
	}

}


async function getData(url)
{
	const response = await fetch(url);
	return response;
}


function dataToArray(data)
{
	var arr = [];
	for (var entry of data) {
		var row = [];
		for (var key in entry) {
			row.push(entry[key]);
		}
		arr.push(row);
	}

	return arr;
}


async function tableEditorFormHandler(event)
{
	event.preventDefault();

	// здесь надо как-то всплыть на editor

	if (!event.target.editor.form.validateFields()) {
		return
	}
	
	event.target.editor.setLoading(true);
	const resp1 = await event.target.editor.form.sendData(
		event.target.editor.postURL,
		document.querySelector('meta[name="csrf-token"]').content);
	if (!resp1.ok) return;

	var resp2 = await getData(event.target.editor.getURL);
	if (!resp2.ok) return;
	
	var json = await resp2.json();
	event.target.editor.setLoading(false);
	event.target.editor.table.updateData(dataToArray(json.data));
}


function tableRowDeleteHandler(event)
{
	if (event.target.tagName != "BUTTON") return;
	if (event.target.innerHTML != "Удалить") return;
	
	var primaryParam = event.target.closest("tr")
		.children[event.target.closest("tbody").primaryIndex].innerHTML;
	console.log(primaryParam);
}


export default class TableEditor
{
	name
	form
	table
	element
	getURL
	postURL


	constructor(name, getURL, postURL)
	{
		this.name = name;
		this.getURL = getURL;
		this.postURL = postURL;

		this.table = new Table(name);
		this.form  = new TableEditorForm(name);

		this.element = document.createElement("div");
		this.element.className = "accordion m-4 shadow-sm";
		this.element.id = `editor-${this.name}`;
		this.element.innerHTML = `
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
				data-bs-parent="#editor-${this.name}"
			>
				<div class="accordion-body">
					${this.form.element.outerHTML}
				</div>
			</div>
		</div>
		<div class="accordion-item">
			<div class="accordion-body">
				${this.table.element.outerHTML}
			</div>
		</div>`;
	}


	async init()
	{
		this.element = document.getElementById(this.element.id);
		
		this.table.init();
		this.table.setLoading(true);

		this.form.init();
		this.form.element.editor = this;
		this.form.element.onsubmit = tableEditorFormHandler;

		var response = await getData(this.getURL);
		if (!response.ok) {
			this.table.setLoading(false);
			return;
		}

		var json = await response.json();

		for (var i = 0; i < json.colinfo.length; i++) {
			if (json.colinfo[i][3]) {
				this.form.addField(json.colinfo[i][0], json.colinfo[i][1], json.colinfo[i][2])
			}
		}
		this.form.addField(null, "Добавить", "submit");

		var columns = [];
		for (var info of json.colinfo) {
			columns.push(info[1]);
		}

		this.table.setData(dataToArray(json.data), columns);

		this.table.tbody.primaryIndex = json.primaryIndex;
		this.table.tbody.onclick = tableRowDeleteHandler;

		this.table.setLoading(false);
	}


	setLoading(status)
	{
		this.form.setLoading(status);
		this.table.setLoading(status);
	}
}

