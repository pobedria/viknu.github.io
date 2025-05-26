$(document).click( function(e){
    if (( $(e.target).closest('#search_form').length ) || ( $(e.target).closest('#search_btn').length ))
	{ 
        return;
    }
     
	$("#search_form").css("width", "0px");
	$("#search_query").val("");
});
function xs_nav(title) 
{
	if($(title).hasClass("xs_nav_active") && ($(".xs_nav_unactive").css("display") == "block") ) 
	{
		$(".xs_nav_unactive").css("display", "none");
		$(".xs_nav_tabs_arrow").css("transform", "rotate(0deg)");
		return;
	}
	$(".xs_nav_tabs_arrow").css("transform", "rotate(180deg)");
	$(".xs_nav_unactive").css("display", "block");
	
	
	if($(title).hasClass("xs_nav_unactive"))
	{
		$(".xs_nav").addClass("xs_nav_unactive");
		$(".xs_nav").removeClass("xs_nav_active");
		$(title).removeClass("xs_nav_unactive");
		$(title).addClass("xs_nav_active");
		$(".xs_nav_tabs_arrow").css("transform", "rotate(0deg)");
		$(".xs_nav_unactive").css("display", "none");
	}
}  
function change_capcha()
{
	var request = new XMLHttpRequest();
	request.onreadystatechange = (function()
	{
		if(request.readyState == 4)
		{
			if(request.status == 200)
			{
				var ajax = eval(request.responseText);
				if(ajax[0].alert == 1)	document.getElementById("capcha_img").outerHTML = "<img src='/capcha?" + Math.random() + "' id='capcha_img'>";
			}
		}
	});
	request.open("get", "/capcha/new", true);
	request.send(null);
}     
function redirect(url, new_window)
{ 
	if(new_window == 1)
		window.open(url, '');
	else
		document.location.href = url; 
}
function fancy(name)
{ 
Fancybox.show([{ src: '#' + name  }]);
}
function fancy_src(url)
{  
	Fancybox.show([{ src: url  }]);
}
function showhide(divblock) 
{ 
	if( $("#" + divblock).css('display') == 'none' ) 
	{
		$("#" + divblock).animate({height: 'show'}, 400);
	}
	else 
	{
		$("#" + divblock).animate({height: 'hide'}, 200);
	}
}
function number_format(number, decimals, dec_point, separator ) {
  number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof separator === 'undefined') ? ',' : separator ,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + (Math.round(n * k) / k)
        .toFixed(prec);
    };
  // Фиксим баг в IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
    .split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '')
    .length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1)
      .join('0');
  }
  return s.join(dec);
}
 