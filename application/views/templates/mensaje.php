<?php

if ($type == "message"){
	echo "<script>alert('".$mensaje."');</script>";
	redirect($location, 'refresh');
}elseif ($type =="confirm"){

	echo "<script>

	confirm('".$mensaje.")
		";

	redirect($location."/true", 'refresh');

	echo "	}


	</script>";
	redirect($location, 'refresh');
}

?>

