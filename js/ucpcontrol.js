function ucpcontrol(){
var headercon= document.getElementById("headercon");
var navcon= document.getElementById("navcon");
var ucpblock= document.getElementById("ucpblock");
var logincon= document.getElementById("logincon");
ucpblock.onmousemove= function() {
	headercon.style.height="590px";
	ucpblock.style.height="510px";
	ucpblock.style.backgroundColor="#eee";
	ucpblock.style.color="#333";
}
ucpblock.onmouseout= function() {
	headercon.style.height="110px";
	ucpblock.style.height="30px";
	ucpblock.style.backgroundColor="#3389ca";
	ucpblock.style.color="#fff";
}
}