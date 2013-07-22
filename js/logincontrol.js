// JavaScript Document
function loginexpand(){  
        	    var logincon= document.getElementById("logincon");
				var registerbox= document.getElementById("registerbox");
				var caption1= document.getElementById("caption1");
				var caption2= document.getElementById("caption2");
				logincon.style.height="300px";
				}
function loginexpandreg(){  
        	    var logincon= document.getElementById("logincon");
				var registerbox= document.getElementById("registerbox");
				var caption1= document.getElementById("caption1");
				var caption2= document.getElementById("caption2");
				logincon.style.height="300px";
				registerbox.style.height="250px";
				caption1.style.display="none";
				caption2.style.display="inline";
				}
function registerexpand(){  
        	    var logincon= document.getElementById("logincon");
				var registerbox= document.getElementById("registerbox");
				var caption1= document.getElementById("caption1");
				var caption2= document.getElementById("caption2");
				registerbox.style.height="250px";
				caption1.style.display="none";
				caption2.style.display="inline";
				}
function registerhide(){  
        	    var logincon= document.getElementById("logincon");
				var registerbox= document.getElementById("registerbox");
				var caption1= document.getElementById("caption1");
				var caption2= document.getElementById("caption2");
				registerbox.style.height="40px";
				caption1.style.display="inline";
				caption2.style.display="none";
				}
function loginhide(){  
        	    var logincon= document.getElementById("logincon");
				var registerbox= document.getElementById("registerbox");
				var caption1= document.getElementById("caption1");
				var caption2= document.getElementById("caption2");
				logincon.style.height="0px";
				caption1.style.display="inline";
				caption2.style.display="none";
				registerbox.style.height="40px";
				}
