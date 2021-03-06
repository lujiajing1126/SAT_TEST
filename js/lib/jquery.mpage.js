/**
* jQuery mPage v0.4
*
* @Plugin Name: mPage
* @author: megrez
* @Update Time:Jul 30, 2013
*
* Copyright 2013 Megrez
* Powered By jQuery
*/
; (function ($) {
    var jsonarray, currentpage, count, parent, allpage, perpage;
    var methods = {
        init: function (data) {
            jsonarray = data;
            currentpage = $.fn.mpage.defaults.start;
            count = $(jsonarray).size();
            allpage = Math.ceil(count / perpage);
        }
    };
    $.fn.mpage = function (options,data) {
        parent = this;
        var opts = $.extend({}, $.fn.mpage.defaults, options);
        perpage = opts.perpage;
        methods.init(data);
        appendNav();
        $.fn.mpage.appendPerRec(currentpage);
    };
    function appendNav() {
    	$(".holder").empty();
    	$(".holder").append('<div><a class="mpage_refresh arrow" onclick="loadctb();showpriority();"><i class="icon-arrows-ccw" style="position:relative; top:8px;"></i></a></div>');
    	if(allpage!=0 && allpage !=1)  {
    		$(".holder").append('<a class="mpage_prev arrow">prev</a>');
    	}
        for(i=1;i<=allpage;i++) {
        	if(allpage<=11)  {
        		$(".holder").append('&nbsp;&nbsp;&nbsp;');
        		$(".holder").append('<a class="mpage_no arrow">'+i+'</a>');
        	}else if(allpage>11)  {
        		$(".holder").append('&nbsp;&nbsp;&nbsp;');
        		if(i==1)  {
        			$(".holder").append('<a class="mpage_no arrow">'+1+'</a>');
        		}else if(i==allpage && allpage !=1)  {
        			$(".holder").append('<a class="mpage_no arrow">'+i+'</a>');
        		}else if((i<currentpage-5 && i>1) || (i>currentpage+5 && i<allpage))  {
        			$(".holder").append('<a>'+'...'+'</a>');
        		}else {
        			$(".holder").append('<a class="mpage_no arrow">'+i+'</a>');
        		}
        	}
        }
        if(allpage!=0 && allpage !=1)  {
        	$(".holder").append('&nbsp;&nbsp;&nbsp;');
        	$(".holder").append('<a class="mpage_next arrow">next</a>');
        }
        setTimeout(bindNav(),100);
    };

    function appendAllRecord() {
        $.each(jsonarray, function (i, value) {
            parent.append("a json record:" + value);
            parent.append("<BR>");
        });
    };

    function bindNav() {
        $(".mpage_prev").click(function () {
            parent.empty();
            if(currentpage >1) currentpage = currentpage - 1;
            $.fn.mpage.appendPerRec(currentpage);
        });
        $(".mpage_next").click(function () {
            parent.empty();
            if(currentpage < allpage) currentpage = currentpage + 1;
            $.fn.mpage.appendPerRec(currentpage);
        });
        $(".mpage_no").click(function () {
            parent.empty();
            currentpage = parseInt($(this).text());
            $.fn.mpage.appendPerRec(currentpage);
        });
    };

    function debug(obj) {
        console.log(obj);
    };

    $.fn.mpage.appendPerRec = function(page) {
		
        var startrec = (page-1) * perpage
            ,endrec = startrec + perpage -1
            , i;
        if(endrec > (count-1)) endrec = count-1;
        	
        var tbody="";
        for (i = startrec; i <= endrec; i++) {
        	var trs = "";
			trs += "<script>";
			trs += "function selectfavoriteitem"+i+"() {";
			trs += "sectionval= \""+jsonarray[i].section+"\";";
			trs += "questionval= \""+jsonarray[i].qnumber+"\";";
			trs += "itemval= \""+jsonarray[i].set+"\";";
			trs += "inputitemnum.value= itemval;";
			trs += "inputsectionnum.value= sectionval;";
			trs += "inputquestionnum.value= questionval;";
			trs += "loadtiku();";
			trs += "}";
			trs += "</script>";
			trs += "<li><div class=\"ucplistitem\" onclick=\"selectfavoriteitem"+i+"()\">";
			trs += "<div class=\"ucplistitemtext\"><div style=\"float:left;\">Section "+ jsonarray[i].section+ " Question "+ jsonarray[i].qnumber+ "</div><div style=\"float:right; width:150px;\">"+ jsonarray[i].addtime+ "</div><div name=\"itempriority\" style=\"float:right; width:150px; text-align:left; padding-top:12px;\">"+jsonarray[i].priority+"</div></div>";
			trs += "<div class=\"ucplistitemdate\">"+ jsonarray[i].set + "</div>";
			trs += "<div class=\"ucplistitemlabel\" name=\"questionlabel\">"+ $.trim(jsonarray[i].category) + "</div></div></li>";
			tbody += trs;
			
        }
		
        parent.empty();
        parent.append(tbody);
        resetlabelcolor();
		showpriority();
    };

    $.fn.mpage.defaults = {
        start: 1,
        perpage: 10
    };
})(jQuery)