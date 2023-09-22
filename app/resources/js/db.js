import TableEditor from "./table.js";

var tableEditor = new TableEditor("names", "/db/get", "/db/post");
document.getElementById('content-block').appendChild(tableEditor.element);
tableEditor.init();