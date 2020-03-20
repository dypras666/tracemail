<?php

/**
 * @Author: Lampung Media Technology
 * @Date:   2020-01-04 15:32:22
 * @Last Modified by:   Kurniawan
 * @Last Modified time: 2020-01-04 17:08:07
 */
?>
<script type="text/javascript">
var csfr_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
var csfr_token_value = '<?php echo $this->security->get_csrf_hash(); ?>';

const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});


$(document).ready(function(){
  $("#trace").click(function(){   

    $(this).html("SEARCHING...").attr("disabled", "disabled");
    var data =  {
    term : $("#term").val(),
	  }
	data[csfr_token_name] = csfr_token_value;
    $.ajax({
      url: '<?= base_url('home/search')?>',  
      type: 'POST',  
      data:  data ,  
      dataType: "json",
      beforeSend: function(e) {
        if(e && e.overrideMimeType) {
          e.overrideMimeType("application/json;charset=UTF-8");
        }
      },
      success: function(response){  
        $("#trace").html("TRACE").removeAttr("disabled");
        $("#show").fadeIn('300');
        $("#show").html(response.hasil);
      },
      error: function (xhr, ajaxOptions, thrownError) {  
        alert(xhr.responseText);  
        $("#trace").html("TRACE").removeAttr("disabled");
      }
    });
  });
});
</script>