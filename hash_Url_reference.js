function record_Url() {
	const requestToStoreUrl = new XMLHttpRequest();
	requestToStoreUrl.open("POST", "record_Url.php");

	requestToStoreUrl.onload = function () {
		alert(this.response);
		document.querySelector("#UrlForm").reset();
	}
	requestToStoreUrl.send(new FormData(document.querySelector("#UrlForm")));
}

document.querySelector("#record_Url").addEventListener("click", record_Url, true);
