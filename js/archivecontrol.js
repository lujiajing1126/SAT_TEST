function sectionclick() {
	switch (sectionval) {
		case "Section 1":
			inputsectionnum.value= "1";
		break;
		case "Section 2":
			inputsectionnum.value= "2";
		break;
		case "Section 3":
			inputsectionnum.value= "3";
		break;
		case "Section 4":
			inputsectionnum.value= "4";
		break;
		case "Section 5":
			inputsectionnum.value= "5";
		break;
		case "Section 6":
			inputsectionnum.value= "6";
		break;
		case "Section 7":
			inputsectionnum.value= "7";
		break;
		case "Section 8":
			inputsectionnum.value= "8";
		break;
		case "Section 9":
			inputsectionnum.value= "9";
		break;
		case "Section 10":
			inputsectionnum.value= "10";
		break;
	}
}

function questionclick() {
	switch (questionval) {
		case "1":
			inputquestionnum.value= "1";
		break;
		case "2":
			inputquestionnum.value= "2";
		break;
		case "3":
			inputquestionnum.value= "3";
		break;
		case "4":
			inputquestionnum.value= "4";
		break;
		case "5":
			inputquestionnum.value= "5";
		break;
		case "6":
			inputquestionnum.value= "6";
		break;
		case "7":
			inputquestionnum.value= "7";
		break;
		case "8":
			inputquestionnum.value= "8";
		break;
		case "9":
			inputquestionnum.value= "9";
		break;
		case "10":
			inputquestionnum.value= "10";
		break;
		case "11":
			inputquestionnum.value= "11";
		break;
		case "12":
			inputquestionnum.value= "12";
		break;
		case "13":
			inputquestionnum.value= "13";
		break;
		case "14":
			inputquestionnum.value= "14";
		break;
		case "15":
			inputquestionnum.value= "15";
		break;
		case "16":
			inputquestionnum.value= "16";
		break;
		case "17":
			inputquestionnum.value= "17";
		break;
		case "18":
			inputquestionnum.value= "18";
		break;
		case "19":
			inputquestionnum.value= "19";
		break;
		case "20":
			inputquestionnum.value= "20";
		break;
		case "21":
			inputquestionnum.value= "21";
		break;
		case "22":
			inputquestionnum.value= "22";
		break;
		case "23":
			inputquestionnum.value= "23";
		break;
		case "24":
			inputquestionnum.value= "24";
		break;
		case "25":
			inputquestionnum.value= "25";
		break;
		case "26":
			inputquestionnum.value= "26";
		break;
		case "27":
			inputquestionnum.value= "27";
		break;
		case "28":
			inputquestionnum.value= "28";
		break;
		case "29":
			inputquestionnum.value= "29";
		break;
		case "30":
			inputquestionnum.value= "30";
		break;
	}
}

var archiveitemitems= document.getElementsByName("archiveitem");
var archivesectionitems= document.getElementsByName("archiveitemclick");
var archiveiteminfocon= document.getElementsByName("archiveiteminfocon");
function clearsection() {
	for (i=0;i<archivesectionitems.length;i++){
		archivesectionitems.item(i).style.height="20px";
	}
}
function clearitem() {
	for (i=0;i<archiveitemitems.length;i++){
		archiveitemitems.item(i).style.height= "0px";
		archiveitemitems.item(i).style.overflow= "hidden";
	}
	for (i=0;i<archiveiteminfocon.length;i++){
		archiveiteminfocon.item(i).className= "archiveiteminfocon";
	}
	
}




function prevquestion() {
    questionval0=Number(questionval);
    
    if (questionval0==1) {
        questionval0=1;
        
    }
    else {
        
        questionval0=questionval0-1;
        questionval=String(questionval0);
        inputquestionnum.value= questionval;
        
        loadtiku();
        
    }
}
function nextquestion() {
    questionval0=Number(questionval);
    if (questionval0==questionlength) {
        questionval0=questionlength;
        
    }
    else {
        questionval0=questionval0+1;
        questionval=String(questionval0);
        inputquestionnum.value= questionval0;
        loadtiku();
        
    }
}