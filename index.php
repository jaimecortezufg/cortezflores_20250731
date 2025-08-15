<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>CF1004001 JAIME JEOVANNY CORTEZ FLORES</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
		<script src="js/jquery-3.7.1.min.js"></script>
		<script src="js/bootstrap.bundle.min.js"></script>
		<script src="js/sha1.js"></script>
	</head>
	<body>
		<div class="container-fluid">
			<div class="contenedor">
				<div class="row align-items-center h-100">
					<div class="col"></div>
					<div class="col">
						<div class="align-items-center">
							<p>CF1004001 JAIME JEOVANNY CORTEZ FLORES</p>
							<form name="frm_login" id="frm_login" method="post" action="core/process.php">
								<table>
									<thead>
										<tr>
											<th class="parrafo_centrado">Inicio de sesión</th>
										</tr>
										<tr>
											<th>&nbsp;</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<div class="form-row">
													<div class="form-group col-md-6">
														<label for="txt_usuario">Usuario: </label>
														<input type="text" class="form-control" name="txt_usuario" id="txt_usuario" maxlength="15" aria-describedby="txt_user_help" required />
														<small id="txt_user_help" class="form-text text-muted">El usuario es obligatorio</small>
													</div>
													<div class="form-group col-md-6">
														<label for="txt_password">Contraseña: </label>
														<input type="password" class="form-control" name="txt_password" id="txt_password" maxlength="15" aria-describedby="txt_password_help" required />
														<small id="txt_password_help" class="form-text text-muted">La contraseña es obligatoria</small>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td align="center">
												<button type="button" class="btn btn-primary" name="btn_entrar" id="btn_entrar">Iniciar sesión</button>
												<div class="mensaje"></div>
											</td>
										</tr>
									</tbody>
								</table>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>
			function enviar_datos(u,p){

				$.post(
					$("#frm_login").attr("action"), //Ruta para envío de datos (URI)
					{
						txt_usuario: u,
						txt_password: p
					}
				).done(function(datos){
					window.location.replace(datos.data.url+"?token="+datos.data.token);
				}).fail(function(xhr,status,error){
					$(".mensaje").html(xhr.responseJSON.error.message)
				});
			}
			$(document).ready(function(){
					//SI LA PERSONA PRESIONA EL BOTÓN "INICIAR SESIÓN"
					$("#btn_entrar").click(function(){
						//SE EJECUTA LA FUNCIÓN enviar_datos()
						enviar_datos($("#txt_usuario"),$("#txt_password"));
					});

					//SI LA PERSONA PRESIONA "ENTER" MIENTRAS EL FOCUS ESTÁ EN EL CAMPO
					// txt_usuario
					$("#txt_usuario").keypress(function(event){
						//SE EVALÚA SI LA TECLA PRESIONADA ES "ENTER"
						if(event.which == 13){
							//SE EJECUTA LA FUNCIÓN enviar_datos()
							enviar_datos($("#txt_usuario"),$("#txt_password"));
						}
					});
					//SI LA PERSONA PRESIONA "ENTER" MIENTRAS EL FOCUS ESTÁ EN EL CAMPO
					// txt_password
					$("#txt_password").keypress(function(event){
						//SE EVALÚA SI LA TECLA PRESIONADA ES "ENTER"
						if(event.which == 13){
							//SE EJECUTA LA FUNCIÓN enviar_datos()
							enviar_datos($("#txt_usuario"),$("#txt_password"));
						}
					});
				});
		</script>
	</body>
</html>