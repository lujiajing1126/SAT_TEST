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