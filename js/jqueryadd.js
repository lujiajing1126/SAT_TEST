
function show(){
    var Node=$("#win");
    Node.fadeIn("slow");
   // document.onmousemove=move;    
}

function hide(){
   var Node=$("#win");
   Node.fadeOut("slow");
   Node.hide("slow");
}
function move(){
    document.getElementById("win").style.left=event.clientX;
    document.getElementById("win").style.top=event.clientY;
}