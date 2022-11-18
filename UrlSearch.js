// search every Url for a match
document.querySelector("#hsearch").addEventListener("change", function(){
	// get the search query and remove white space
	const search = this.value.trim();
	if (search == "") return;
	
	const tbody = document.getElementsByTagName("tbody");
	const tr = document.getElementsByTagName("tr");
	const size = tr.length;

	for (var i = 1; i < size; i++) {
		const td = tr[i].children;
		const text = td[3].children[0].innerHTML;

		const regx = new RegExp(search,"gi");
		const result = text.replace(regx, `<mark>${search}</mark>`);
		td[3].children[0].innerHTML = result;
	}
}, true);

// search for UrlDirectories 
document.querySelector("#searchDir").addEventListener("keyup", function(){
	const tbody = document.getElementsByTagName("tbody");
	const tr = document.getElementsByTagName("tr");
	const size = tr.length;
	
	for (var i = 1; i < size; i++) searchDir_tr(tr[i], this.value);
}, true);

function searchDir_tr(tr, DirSearch) {
	const size = tr.children.length;
	const td = tr.children;

	const checkbox = td[5].children[0];
	const td_Dir = td[4].children[0].innerHTML;

	if (DirSearch == td_Dir) {
		checkbox.checked = true;
		tr.scrollIntoView();
	}
	else if (DirSearch == "") tr.style.display = "block";
	else if (DirSearch != td_Dir) checkbox.checked = false;
}

function hsearch(hinput) {
	const text = hinput.innerHTML;
	const regx = new RegExp(search,"gi");
	const result = text.replace(regx, `<mark>${search}</mark>`);
	item.innerHTML = result;
}
