<?php
require_once( '../includes/variables.php' );
require_once( '../includes/head.php' )
?>
	<meta name="description" content="About M.O.R.A.C.E.">
	<title>M.O.R.A.C.E.</title>
</head><body>
	<?php
	$words = "the the the the the the the the in in in in in to to to to s s s ed ed ed ing ing ing run sit swim walk think want need remember when when if if if of of of then then then dress beauty love knowledge hit speak say do I I I I me me me my my my you you you you your your your your they they they their their their them them them them to to to to at at at at end beginning start blade moon sun lake water fire earth air sky sink rise low high red blue green purple fall stand take give make for for for and and and and a a a a an an impossible ample skin hill valley mountain still fog time space vast small keep have play greet dead gone life vibrant joy over under within on on path black white free quick slow bright light dark blood heart soul hand body mind edge night day art bleed breathe sing";
	$wordlist = explode(" ", $words);
	foreach ( $wordlist as $word ) {
		echo "<span class='draggable'>" . $word . "</span>";
	}
	?>
<script>
$("document").ready(function() {
$(".draggable").each(function(index, value) {
	scatter(value);
	dragElement(value);
	renameable(value);
});
function renameable(elmnt) {
	elmnt.ondblclick = rename;
	function rename(e) {
		e = e || window.event;
		e.preventDefault();
		elmnt.setAttribute("contentEditable", "true");
		elmnt.focus();
		setEndOfContenteditable(elmnt);
		document.onkeydown = checkEnter;
		elmnt.onblur = unedit;
	}
	function checkEnter(e) {
		e = e || window.event;
		if(e.which == 13) {
			e.preventDefault();
			unedit(elmnt);
		}
	}
	function unedit(e) {
		elmnt.blur();
		elmnt.setAttribute("contentEditable", "false");
	}
	function setEndOfContenteditable(contentEditableElement) {
		var range,selection;
		if(document.createRange)//Firefox, Chrome, Opera, Safari, IE 9+
		{
			range = document.createRange();//Create a range (a range is a like the selection but invisible)
			range.selectNodeContents(contentEditableElement);//Select the entire contents of the element with the range
			range.collapse(false);//collapse the range to the end point. false means collapse to end rather than the start
			selection = window.getSelection();//get the selection object (allows you to change selection)
			selection.removeAllRanges();//remove any selections already made
			selection.addRange(range);//make the range you have just created the visible selection
		}
		else if(document.selection)//IE 8 and lower
		{ 
			range = document.body.createTextRange();//Create a range (a range is a like the selection but invisible)
			range.moveToElementText(contentEditableElement);//Select the entire contents of the element with the range
			range.collapse(false);//collapse the range to the end point. false means collapse to end rather than the start
			range.select();//Select the range (make it the visible selection
		}
	}
}
function scatter(elmnt) {
	var margin = 100;
	var height = window.innerHeight - margin*2;
	var width = window.innerWidth - margin*2;
	elmnt.style.top = margin + (Math.random()*height) - elmnt.offsetHeight/2 + "px";
	elmnt.style.left = margin + (Math.random()*width) - elmnt.offsetWidth/2 + "px";
}
function dragElement(elmnt) {
	var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
	elmnt.onmousedown = dragMouseDown;
	function dragMouseDown(e) {
		e = e || window.event;
		e.preventDefault();
		elmnt.parentNode.appendChild(elmnt);
		pos3 = e.clientX;
		pos4 = e.clientY;
		document.onmouseup = closeDragElement;
		document.onmousemove = elementDrag;
	}
	function elementDrag(e) {
		e = e || window.event;
		e.preventDefault();
		pos1 = pos3 - e.clientX;
		pos2 = pos4 - e.clientY;
		pos3 = e.clientX;
		pos4 = e.clientY;
		elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
		elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
	}
	function closeDragElement() {
		document.onmouseup = null;
		document.onmousemove = null;
	}
}	
});
</script>