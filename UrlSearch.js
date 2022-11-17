// search through all the Url Descriptor, and highlight search results
document.querySelector("#hsearch").addEventListener("click", function(){
	// get the search query and remove white space
	const search = document.querySelector("#iframeSearch").value.trim();

	// search every Url descriptor: for the search input
	const iframes = Array.from(document.querySelectorAll("#Descriptor"));
	iframes.forEach(function(item){
		const text = item.innerHTML;
		const regx = new RegExp(search,"gi");
		const result = text.replace(regx, `<mark>${search}</mark>`);
		item.innerHTML = result;
	});
}, true);

// search for UrlDirectories 
document.querySelector("#searchDir").addEventListener("keyup", function(){
	const table = document.querySelector("#Url_index");
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
		tr.style.filter = "blur(0)";
	} 
	else if (DirSearch == "") tr.style.display = "block";
	else if (DirSearch != td_Dir) checkbox.checked = false;
}
