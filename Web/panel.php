<?php
	require "header.php";
?>
	<main>
		<div class="main-wrapper">
			<button class="button1" onclick="">Generate New Key</button>

			<?php	 
				$key = $_SESSION['keyAuth'];
				echo "<input type='text' value='$key'/>";
			
			?>
		</div>
	</main>

    <?php

    ?>

<?php
	require "footer.php";
?>
