// phan nút bấm của giỏ hàng
function cong(){
			var t =document.getElementById("textbox").value;
			document.getElementById("textbox").value = parseInt(t)+ 1;
		}
function tru(){
	var t =document.getElementById("textbox").value;
	if (parseInt(t)>1) {
	document.getElementById("textbox").value = t- 1;
		}
		}

function sotienthanhtoan(){
	var t =document.getElementById("textbox").value
	var n =document.getElementById("sotienthanhtoan").value
	document.getElementById("sotienthanhtoan").value= n*t;
}