function toolbarclear() {
var button1= document.getElementById("originaltextbutton");
var archivecontainer= document.getElementById("archivecontainer");
var textscrollbar= document.getElementById("textscrollbar");
var button2= document.getElementById("passageanalysisbutton");	
var passageanalysis= document.getElementById("passageanalysis");
var questionanalysis= document.getElementById("questionanalysis");
var button3= document.getElementById("favoritebutton");
var favoritecon= document.getElementById("favoritecon");	
var popupbg= document.getElementById("popupbg0");
var button4= document.getElementById("extendedreadingbutton");
var popupcontainer0= document.getElementById("popupcontainer0");
var viewport3= document.getElementById("viewport3");
	archivecontainer.style.display="block";
	textscrollbar.style.display="none";
	button1.className="toolboxbutL";
	questionanalysis.style.display="block";
	passageanalysis.style.display="none";
	button2.className="toolboxbutR";
	favoritecon.style.height="0px";
	button3.className="toolboxbutR";
	popupbg0.style.height="0px";
	button4.className="toolboxbutR";
}

function originaltext_ctrl() {
var button= document.getElementById("originaltextbutton");
var archivecontainer= document.getElementById("archivecontainer");
var textscrollbar= document.getElementById("textscrollbar");
if (button.className=="toolboxbutL"){
	archivecontainer.style.display="none";
	textscrollbar.style.display="block";
	button.className="toolboxbutLPed";
}
else {
	archivecontainer.style.display="block";
	textscrollbar.style.display="none";
	
	button.className="toolboxbutL";
}
resetheight();
}

function originaltext_ctrl_2() {
var button= document.getElementById("originaltextbutton");
var archivecontainer= document.getElementById("archivecontainer");
var textscrollbar= document.getElementById("textscrollbar");
	archivecontainer.style.display="block";
	textscrollbar.style.display="none";
	
	button.className="toolboxbutL";
resetheight();
}


function passageanalysis_ctrl(){
var button= document.getElementById("passageanalysisbutton");	
var passageanalysis= document.getElementById("passageanalysis");
var questionanalysis= document.getElementById("questionanalysis");
if (button.className=="toolboxbutR"){
	questionanalysis.style.display="none";
	passageanalysis.style.display="block";
	button.className="toolboxbutRPed";
}
else {
	questionanalysis.style.display="block";
	passageanalysis.style.display="none";
	button.className="toolboxbutR";
}
resetheight();
}

function favorite_ctrl(){
var button= document.getElementById("favoritebutton");
var favoritecon= document.getElementById("favoritecon");	
if (button.className=="toolboxbutR"){
	favoritecon.style.height="auto";
	button.className="toolboxbutRPed";
}
else {
	favoritecon.style.height="0px";
	button.className="toolboxbutR";
}
}

function extendedreading_ctrl() {
var popupbg= document.getElementById("popupbg0");
var button= document.getElementById("extendedreadingbutton");
var popupcontainer0= document.getElementById("popupcontainer0");
var viewport3= document.getElementById("viewport3");
if (popupbg0.style.height=="0px"){
	popupbg0.style.height="100%";
	button.className="toolboxbutRPed";
	popupcontainer0.style.display="block";
}
else {
	popupbg0.style.height="0px";
	button.className="toolboxbutR";
	popupcontainer0.style.display="none";
}
viewport3.style.height= popupcontainer0.offsetHeight-60+"px";
$('#extreadingcontainer').tinyscrollbar();	
}