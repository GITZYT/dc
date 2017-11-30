/// <reference path="jquery-1.9.1.min.js" />

  $(function(){
        var h3 = $(".tree_box").find("h3");
        var tree_one = $(".tree_box").find(".tree_one");
        var h4 = $(".tree_one").find("h4");
        var tree_two = $(".tree_one").find(".tree_two");
        
        h3.each(function(i){
            $(this).click(function(){
            	if ($(this).children(".fd-arrow").hasClass("fd-arrow-down")) {
            		
            		$(this).children(".fd-arrow").removeClass("fd-arrow-down");
	            } else{
	            	$(this).parent(".tree_box").siblings().children("h3").find(".fd-arrow").removeClass("fd-arrow-down");
	            	$(this).children(".fd-arrow").addClass("fd-arrow-down");
	            }
            	
                tree_one.eq(i).slideToggle();
                tree_one.eq(i).parent().siblings().find(".tree_one").slideUp();
            })
        })
        h4.each(function(i){
            $(this).click(function(){
            	if ($(this).children(".fd-arrow").hasClass("fd-arrow-down")) {
            		$(this).children(".fd-arrow").removeClass("fd-arrow-down");
            		$(this).parent("li").siblings().find(".fd-arrow").removeClass("fd-arrow-down");
	            } else{
	            	$(this).parent("li").siblings().find(".fd-arrow").removeClass("fd-arrow-down");
	            	$(this).children(".fd-arrow").addClass("fd-arrow-down");
	            }
                tree_two.eq(i).slideToggle();
                tree_two.eq(i).parent().siblings().find(".tree_two").slideUp();
            })
        })
    })