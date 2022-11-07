// search through all the Url Descriptor, and highlight search results
document.querySelector("#hsearch").addEventListener("click", function(){
	// get the search query and remove white space
	const search = document.querySelector("#search").value.trim();

	// search every Url descriptor: for the search input
	const iframes = Array.from(document.querySelectorAll("#Descriptor"));
	iframes.forEach(function(item){
		const text = item.innerHTML;
		const regx = new RegExp(search,"g");
		const result = text.replace(regx, `<mark>${search}</mark>`);

		//highlighted search results
		item.innerHTML = result;
	});
	//alert(document.querySelector("#descriptor"));
}, true);	