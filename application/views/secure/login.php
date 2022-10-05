<style>
	
body {

		background-image: url("../../images/professional.jpg");
		background-repeat: no-repeat;
		background-size: cover;
		width: auto;
		height : 100vh;
	}

</style>

<body>
	


	<div class="login">
		
		<div class="login__logo" ><img src="<?php echo base_url(); ?>images/logo-color.png"></div>
		<h2>Login</h2>
		<p>Por favor ingrese su nombre de usuario y contraseña:</p>
		<form action="<?php echo site_url('pages/index'); ?>" method="POST">
			<br>
			<p>Usuario</p>
			<input type="text" name="username" value="" autofocus/>
			<br><br>
			<p>Password </p>
			<input type="password" name="password" value="" />

			<div><input class="submit" type="submit" value="Ingresar" /></div>
		</form>
	</div>

