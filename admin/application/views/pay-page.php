<html>
<body>
	<form name="payment_post" id="payment_post" action="<?=$post_url?>" method="post">
		<?php
			foreach ($post as $key => $value) {
				echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
			}
		?>
	</form>
	<script type='text/javascript'>
        window.onload=function(){
            document.forms['payment_post'].submit();
        }
	</script>
</body>
</html>


