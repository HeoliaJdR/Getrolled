(function(){
	window.onbeforeunload = function(){
								var request = new XMLHttpRequest();
								request.open('POST', 'stop2.php');
								request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
								request.onreadystatechange = function(){
									if(request.readyState == 4){
										if(request.status == 200){
											console.log(request.responseText);
										} else {
											console.error("nuuuu");
										}
									}
								}
								request.send("");
							}
})()