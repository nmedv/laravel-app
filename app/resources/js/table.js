

class TableRowToolbar
{
	name
	element
	editor
	btnId


	constructor(name, id, editor)
	{
		this.name = name;
		this.editor = editor;
		this.btnId = `row-toolbar-btn-table-${this.name}-${id}`;

		this.element = document.createElement("td");
		this.element.innerHTML = `
		<button
			class="btn btn-light"
			type="button"
			id="${this.btnId}"
			data-bs-toggle="dropdown"
			aria-expanded="false"
		>
			\u2807
		</button>
		<ul class="dropdown-menu" aria-labelledby="${this.btnId}">
			<button class='dropdown-item btn btn-light'>Изменить</button>
			<button class='dropdown-item btn btn-light text-danger'>Удалить</button>
		</ul>`;
	}


	init()
	{
		this.element = document.getElementById(this.btnId).parentElement;
		for (var btn of this.element.lastElementChild.children) {
			btn.editor = this.editor;
			btn.primaryIndex = this.editor.data.primaryIndex;
		}

		this.element.lastElementChild.children[1].onclick = this.deleteHandler;
	}


	async deleteHandler(event)
	{
		// if (event.target.tagName != "BUTTON") return;
		// if (event.target.innerHTML != "Удалить") return;
		
		var primaryParam = event.target.closest("tr").children[event.target.primaryIndex].innerHTML;
		var editor = event.target.editor;
		var body = new URLSearchParams({
			"table": editor.name,
			"id": primaryParam
		});

		editor.setLoading(true);

		const response = await fetch(editor.deleteURL, {
			method: 'POST',
			headers: {
				"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
			},
			body: body
		});

		if (response.ok) {
			await editor.update();
		}

		editor.setLoading(false);
	}
}


class Table
{
	name
	element
	loadScreen
	toolbars
	thead
	tbody
	editor

	constructor(name, editor)
	{
		this.editor = editor;
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
	

	load()
	{	
		var columns = [];
		for (var info of this.editor.data.colinfo) {
			columns.push(info[1]);
		}

		this.thead.innerHTML = this.#generateThead(columns);
		this.update();
	}


	update()
	{
		this.tbody.innerHTML = this.#generateTbody(dataToArray(this.editor.data.data));
		for (var tlbr of this.toolbars) {
			tlbr.init();
		}
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
		this.toolbars = []
		var toolbar;
		var i = 0;
		var tbody = "";
		for (var row of data) {
			tbody += "<tr class ='align-middle'>";
			for (var cell of row) {
				tbody += `<td>${cell}</td>`;
			}
			toolbar = new TableRowToolbar(this.name, i++, this.editor);
			this.toolbars.push(toolbar)
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
	editor
	#hasSubmit = false
	#submitValue

	constructor(name, editor)
	{
		this.name = name;
		this.editor = editor;

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
		this.element.onsubmit = this.sendData;
		this.element.editor = this.editor;

		this.body = document.getElementById(this.body.id);
	}


	load()
	{
		var colinfo = this.editor.data.colinfo;
		for (var i = 0; i < colinfo.length; i++) {
			if (colinfo[i][3]) {
				this.addField(colinfo[i][0], colinfo[i][1], colinfo[i][2])
			}
		}
		
		this.addField(null, "Добавить", "submit");
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
		// if (status) {
		// 	subm.innerHTML = `
		// 	<span
		// 		class="spinner-border spinner-border-sm"
		// 		role="status"
		// 		aria-hidden="true">
		// 	</span>
		// 	<span">${this.#submitValue}</span>`;
		// } else {
		// 	subm.innerHTML = this.#submitValue;
		// }	
	}


	async sendData(event)
	{
		event.preventDefault();

		var editor = event.target.editor;
		if (!editor.form.validateFields()) {
			return
		}
		
		editor.setLoading(true);

		var body = new URLSearchParams((new FormData(event.target)).entries());
		body.append("table", editor.name);

		const response = await fetch(editor.addURL, {
			method: 'POST',
			headers: {
				"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
			},
			body: body
		});

		if (response.ok) {
			await editor.update();
		}

		editor.setLoading(false);
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


export default class TableEditor
{
	name
	form
	table
	element
	getURL
	addURL
	deleteURL
	clearURL
	data


	constructor(tableName)
	{
		this.name = tableName;
		this.getURL = `/tables?table=${this.name}`;
		this.addURL = `/tables/add`;
		this.deleteURL = "/tables/delete";
		this.clearURL = "/tables/clear";

		this.table = new Table(this.name, this);
		this.form  = new TableEditorForm(this.name, this);

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
		this.form.init();

		if (!this.data) {
			this.table.setLoading(true);
			const response = await fetch(this.getURL);
			if (!response.ok) return;
			this.data = await response.json();
			this.table.setLoading(false);
		}

		this.form.load();
		this.table.load();
	}


	async update()
	{
		const response = await fetch(this.getURL);
		if (response.ok) {
			this.data = await response.json();
			this.table.update();
			return 1;
		} else {
			return 0;
		}
	}


	setLoading(status)
	{
		this.form.setLoading(status);
		this.table.setLoading(status);
	}
}

