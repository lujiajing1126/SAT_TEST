/**
* jQuery mPage v0.3
*
* @Plugin Name: mPage
* @author: megrez
* @Update Time:Jul 23, 2013
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
			trs += "<li><div class=\"ucplistitem\">";
			trs += "<div class=\"ucplistitemtext\"><div style=\"float:left;\">Section "+ jsonarray[i].section+ " Question "+ jsonarray[i].qnumber+ "</div><div style=\"float:right;\">"+ jsonarray[i].addtime+ "</div></div>";
			trs += "<div class=\"ucplistitemdate\">"+ jsonarray[i].set + "</div>";
			trs += "<div class=\"ucplistitemlabel\" name=\"questionlabel\">"+ jsonarray[i].category+ "</div></div></li>";
			tbody += trs;
        }
        parent.append(tbody);
    };

    $.fn.mpage.defaults = {
        start: 1,
        perpage: 11
    };
})(jQuery)