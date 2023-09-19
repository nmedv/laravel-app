import Table from "./table.js";

var table = new Table("names");
table.draw(document.getElementById("content-block"));
var form = document.forms.form_names;
form.table = table;
form.addEventListener("submit", formHandler);

var response = await fetch("/db/get");
if (response.ok) {
	var json = await response.json();
	table.populateRecords(json);
} else {
	console.error("Ошибка HTTP: " + response.status);
}

async function formHandler(event)
{
	event.preventDefault();
	
	event.target.table.setLoading(true);

	const response = await fetch('/db/post', {
		method: 'POST',
		headers: {
			"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
		},
		body: new URLSearchParams((new FormData(event.target)).entries())
	});
}