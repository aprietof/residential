<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
/* Add your JavaScript code here.
                     
If you are using the jQuery library, then don't forget to wrap your code inside jQuery.ready() as follows:

jQuery(document).ready(function( $ ){
    // Your code in here 
});

End of comment */ 

var interval = setInterval(function(){
	if (window.location.href.indexOf("action") > -1) {
		document.getElementsByClassName('header_media with_search_2')[0].children[0].style.display = "none";
      	clearInterval('interval');
	}
},1);

</script>
<!-- end Simple Custom CSS and JS -->
