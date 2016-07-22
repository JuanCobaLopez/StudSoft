<html>
<head>
<title>Luxoflux</title>
<script type="text/javascript" src="ajax.js"></script>
<link rel="stylesheet" href="css/style.css">
</head>
<body bgcolor="<?php echo $_SESSION['colorFondo']; ?>">
<?php 
session_start();
include "db_connect.php";

if($_SESSION['pagina']=='pagina para el visitante'){

echo '
<input type="text" id="userName" placeholder="Nombre de usuario" />
<input type="text" id="password" placeholder="Coloca tu contraseña" />
<div class="ancho page1_header"><a onclick="procLogin();" class="banner">Ingresar</a></div>
';

} else {
	include("navBar.php");  
	}

//PAGINAS QUE VISITARA EL ADMINISTRADOR
if($_SESSION['pagina']=='panel de control del administrador'){
echo '
<div class="ancho page1_header"><a href = "actualizar_variable_de_pagina_e_ir.php?pagina=materias" class="banner">Materias</a></div>
<div class="ancho page1_header"><a href = "actualizar_variable_de_pagina_e_ir.php?pagina=docentes" class="banner">Docentes</a></div>
<div class="ancho page1_header"><a href = "actualizar_variable_de_pagina_e_ir.php?pagina=estudiantes" class="banner">Estudiantes</a></div>
<div class="ancho page1_header"><a href = "actualizar_variable_de_pagina_e_ir.php?pagina=inscribir" class="banner">Inscribir</a></div>
';

}

			if($_SESSION['pagina']=='materias'){

			echo '
			<h1>MATERIAS</h1>
			';
			$_SESSION['tabla']='materia';


				//Muestreo de datos de las materias del panel de control del administrador
				$result = mysqli_query($conectador,"select * from materia;"); 
				if ($row = mysqli_fetch_array($result)){ 
					 echo "<table>"; 
					 echo "<tr><td>Id de Materia</td><td>Nombre</td><td>Grupo</td><td>Contraseña</td><td>Eliminar</td><td>Modificar</td></tr>"; 
					 do {
							
					 		echo '
							<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td><a href="proc_eliminar.php?llavePrimaria='.$row[0].'">Eliminar</a></td><td><a href="actualizar_variable_de_pagina_y_id_materia_e_ir.php?pagina=modificar&tabla=materia&llavePrimaria='.$row[0].'">Modificar</a></td></tr>
					 		';

					 } while ($row = mysqli_fetch_array($result)); 
					 echo "</table>"; 
				}
				else {echo "No hay ninguna materia, registra una!";}

				echo '<input type="button" onclick="location.href = ' ."'". "actualizar_variable_de_pagina_e_ir.php?pagina=registrar" ."'". ' " value="Nuevo" />';

			}

			if($_SESSION['pagina']=='registrar'){

			echo '
			<h1>REGISTRAR:</h1>
			';

			$result=mysqli_query($conectador,"describe ".$_SESSION['tabla']);
			$row1=mysqli_fetch_array(mysqli_query($conectador,"describe ".$_SESSION['tabla']));
			$result2=mysqli_query($conectador,"select * from ".$_SESSION['tabla']." where ".$row1[0]."='".$_SESSION['llavePrimaria']."' ");
			$row2=mysqli_fetch_array($result2);
			$n=0;

			if($_SESSION['tabla']=='materia'){
				echo '<p><form id="form1" name="form1" method="post" action="procRegistrarMateria.php">
			          <p>';
			}

			if($_SESSION['tabla']=='usuario'){
				echo '<p><form id="form1" name="form1" method="post" action="procRegistrarDocente.php">
			          <p>';
			}			

			while ($row=mysqli_fetch_array($result)){

					if($n>0){
					echo "<label for='textfield'>".$row[0].": </label>";
					echo "<input type='text' value='' name="."'".$row[0]."'"." id='textfield' /> <p>";
					} else {
						
						if($_SESSION['tabla']=='materia'){
												echo "<input type='text' value='".$row2[$n]."' name="."'".$row[0]."'"." id='textfield' style='visibility:hidden' /> <p>";

								}
						if($_SESSION['tabla']=='usuario'){
						echo "<label for='textfield'>".$row[0].": </label>";
						echo "<input type='text' value='' name="."'".$row[0]."'"." id='textfield' /> <p>";

								}
							}

			$n++;
				}

				echo "<input type='submit' name='button' id='button' value='Registrar'/>
			          </form> <p>";


			}

			//POSIBLE PAGINA QUE SE REUTILIZARÁ POR OTRAS
			if($_SESSION['pagina']=='modificar'){

			echo '
			<h1>MODIFICAR:</h1>
			';

			$result=mysqli_query($conectador,"describe ".$_SESSION['tabla']);
			$row1=mysqli_fetch_array(mysqli_query($conectador,"describe ".$_SESSION['tabla']));
			$result2=mysqli_query($conectador,"select * from ".$_SESSION['tabla']." where ".$row1[0]."='".$_SESSION['llavePrimaria']."' ");
			$row2=mysqli_fetch_array($result2);
			$n=0;
				echo '<p><form id="form1" name="form1" method="post" action="procModificacion.php">
			          <p>';
			while ($row=mysqli_fetch_array($result)){

					if($n==0||$n==3){
					echo "<label for='textfield'>".$row[0].": </label>";
					echo "<input type='text' value='".$row2[$n]."' name="."'".$row[0]."'"." id='textfield' readonly='readonly' /> <p>";
					} else {
						echo "<label for='textfield'>".$row[0].": </label>";
						echo "<input type='text' value='".$row2[$n]."' name="."'".$row[0]."'"." id='textfield' /> <p>";}

			$n++;
				}


				echo "<input type='submit' name='button' id='button' value='Modificar'/>
			          </form> <p>";

			}


			if($_SESSION['pagina']=='docentes'){
			echo '
			<h1>DOCENTES</h1>
			';
			$_SESSION['rol_a_tratar']='docente';
			$_SESSION['tabla']='usuario';

				//Muestreo de datos de los docentes del panel de control del administrador
				$result = mysqli_query($conectador,"select userName, nombre, apellido, foto, email, telefono, descripcion, url, estado from usuario where rol = 'docente';"); 
				if ($row = mysqli_fetch_array($result)){ 
					 echo "<table>"; 
					 echo "<tr><td>Nombre de usuario</td><td>Nombre</td><td>Apellido</td><td>Foto</td><td>Correo</td><td>Telefono</td><td>Descripcion</td><td>Web</td><td>Estado</td><td>Eliminar</td><td>Modificar</td></tr>"; 
					 do {
					 		echo '
							<tr><td>'.$row[0].'</td><td>'.($row[1]).'</td><td>'.($row[2]).'</td><td><a href="procVerfoto.php?pagina=verFoto&foto='.$row[3].'">Ver Foto</a></td><td>'.($row[4]).'</td><td>'.($row[5]).'</td><td>'.($row[6]).'</td><td>'.($row[7]).'</td><td>'.($row[8]).'</td><td><a href="proc_eliminar.php?llavePrimaria='.$row[0].'">Eliminar</a></td><td><a href="actualizar_variable_de_pagina_y_id_materia_e_ir.php?pagina=modificar&tabla=usuario&llavePrimaria='.$row[0].'">Modificar</a></td></tr>
					 		';

					 } while ($row = mysqli_fetch_array($result)); 
					 echo "</table>"; 
				}
				else {echo "No hay ningun estudiante, registra uno!";}


				echo '<p><input type="button" onclick="location.href = ' ."'". "actualizar_variable_de_pagina_e_ir.php?pagina=registrar" ."'". ' " value="Nuevo" />';
			}

			if($_SESSION['pagina']=='verFoto'){

			echo '
			<h1>FOTO:</h1>
				
			<img src="imagenes/'.$_SESSION['foto'].'" width="100" height="100">
			';

			}

			if($_SESSION['pagina']=='estudiantes'){

			echo '
			<h1>ESTUDIANTES</h1>
			';

			$_SESSION['tabla']='usuario';
			$_SESSION['rol_a_tratar']='estudiante';
				//Muestreo de datos de los estudiantes del panel de control del administrador
				$result = mysqli_query($conectador,"select userName, nombre, apellido, foto, email, telefono, estado from usuario where rol = 'estudiante';"); 
				if ($row = mysqli_fetch_array($result)){ 
					 echo "<table>"; 
					 echo "<tr><td>Nombre de usuario</td><td>Nombre</td><td>Apellido</td><td>Foto</td><td>Correo</td><td>Telefono</td><td>Eliminar</td><td>Modificar</td><td>Estado</td></tr>"; 
					 do {

					 		echo '
							<tr><td>'.$row[0].'</td><td>'.($row[1]).'</td><td>'.($row[2]).'</td><td><a href="procVerfoto.php?pagina=verFoto&foto='.$row[3].'">Ver Foto</a></td><td>'.($row[4]).'</td><td>'.($row[5]).'</td><td>'.($row[6]).'</td><td><a href="proc_eliminar.php?llavePrimaria='.$row[0].'">Eliminar</a></td><td><a href="actualizar_variable_de_pagina_y_id_materia_e_ir.php?pagina=modificar&tabla=usuario&llavePrimaria='.$row[0].'">Modificar</a></td></tr>
					 		';

/*							
					 		echo '
							<tr><td>'.$row[0].'</td><td>'.md5($row[1]).'</td><td><a href="proc_eliminar.php?llavePrimaria='.$row[0].'">Eliminar</a></td><td><a href="actualizar_variable_de_pagina_y_id_materia_e_ir.php?pagina=modificar&tabla=usuario&llavePrimaria='.$row[0].'">Modificar</a></td></tr>
					 		';
*/
					 } while ($row = mysqli_fetch_array($result)); 
					 echo "</table>"; 
				}
				else {echo "No hay ningun estudiante, registra uno!";}

				echo '<p><input type="button" onclick="location.href = ' ."'". "actualizar_variable_de_pagina_e_ir.php?pagina=registrar" ."'". ' " value="Nuevo" />';

			}

			if($_SESSION['pagina']=='inscribir'){

			echo '
			<h1>CARGA ESTUDIANTES PARA INSCRIBIRLOS:</h1>';
			echo '<form enctype="multipart/form-data" id="form1" name="form1" method="post" action="procInscribir.php">';
			echo  "<input type='hidden' name='MAX_FILE_SIZE' value='10000000000' />
	          <input name='fichero_usuario' type='file' /><p>";

			echo "
			<p><input type='text' name='colocarMateria' value='' placeholder='Nombre de materia' />
			<p><input type='text' name='colocarGrupoMateria' value='' placeholder='Grupo' />
			<p><input type='text' name='colocarContraseñaMateria' value='' placeholder='Contraseña' />
			<p><input type='submit' name='button' id='button' value='Inscribir'/>
	          </form>";

			echo	'
				<input type="button" onclick="location.href = ' ."'". "actualizar_variable_de_pagina_e_ir.php?pagina=continuar inscripcion" ."'". ' " value="Inscribir Rezagados" />
				';

			}

						if($_SESSION['pagina']=='continuar inscripcion'){

						echo '
						<h1>INSCRIBIR REZAGADO</h1>
						<p>Selecciona la materia a la que quieres inscribirlo<br>
						<form method="post" action="procInscripcionRezagados.php">
						';

						$c=0;

						$result = mysqli_query($conectador,"select nombre_materia, grupo_materia, id_materia from materia;"); 
			 
			        echo "<table><tr><td><input type='text' name='userName' placeholder='Coloca el user name' /></td></tr><td>";

			        if ($row = mysqli_fetch_array($result)){ 
			           while ($row = mysqli_fetch_array($result)) {
			              echo "<br><input type='radio' name='idMateria' value='".$row[2]."' />".$row[0].",grupo ".$row[1].". (id: ".$row[2].")";
			           }  
			        }			        
		           echo " 
		           </td></tr><br><tr><td><input type='submit' name='SGTE' id='SGTE' value='Inscribir' />
			           </td></tr></table></form>
			           "; 

						}









if($_SESSION['pagina']=='materias del docente'){
//Muestreo de datos
	echo '<h1>SELECCIONE UNA DE SUS MATERIAS:<p>';

			$result = mysqli_query($conectador,"select m.nombre_materia, mu.id_materia, m.grupo_materia, m.contrasena_materia from materia_usuario mu, materia m where mu.userName = '".$_SESSION['userName']."' and mu.id_materia = m.id_materia "); 
		
		if ($row = mysqli_fetch_array($result)){ 
			 echo "<table>"; 
			 echo "<tr><td>Materias:</td></tr>"; 
			 do {					
			 		echo '
			 		<tr><td><input type="button" onclick="location.href = ' ."'". "actualizar_variable_de_pagina_e_ir_y_actualizar_variable_materia.php?materia=".$row[0]." &id_materia=".$row[1]." &grupo_materia=".$row[2]." &contrasena_materia=".$row[3]." &pagina=panel de control del docente" ."'". ' " value="'.$row[0].'" /></td></tr>
			 		';
			 } while ($row = mysqli_fetch_array($result)); 
			 echo "</table>"; 
		}
		else {echo "No hay materias!";}

}

			if($_SESSION['pagina']=='perfil'){

			echo '
			<input type="button" onclick="location.href = ' ."'". "actualizar_variable_de_pagina_y_id_materia_e_ir.php?pagina=modificar&tabla=usuario&llavePrimaria=" .$_SESSION['userName']."'". ' " value="Modificar Perfil" />
			
			<input type="button" onclick="location.href = ' ."'". "actualizar_variable_de_pagina_e_ir.php?pagina=mensajes" ."'". ' " value="Mensajes" />
			<input type="button" onclick="location.href = ' ."'". "actualizar_variable_de_pagina_e_ir.php?pagina=mi panel" ."'". ' " value="Mi Panel" />
			';

			}


			if($_SESSION['pagina']=='mensajes'){

				echo 'No hay mensajes que mostrar';
				
			}



			if($_SESSION['pagina']=='mi panel'){

				echo '
				Cambia el fondo de tu pagina:
				<form name=fcolores>
				<input type="Radio" name="colorin" value="ffffff" checked> Blanco
				<br>
				<input type="Radio" name="colorin" value="ff0000"> Rojo
				<br>
				<input type="Radio" name="colorin" value="00ff00"> Verde
				<br>
				<input type="Radio" name="colorin" value="0000ff"> Azul
				<br>
				<input type="Radio" name="colorin" value="ffff00"> Amarillo
				<br>
				<input type="Radio" name="colorin" value="00ff00"> Turquesa
				<br>
				<input type="Radio" name="colorin" value="ff00ff"> Morado
				<br>
				<input type="Radio" name="colorin" value="000000"> Negro
				<br>
				<br>
				<input type="Button" name="" value="Cambia Color" onclick="cambiaColor()">
				</form> 
				';
				
			}



			if($_SESSION['pagina']=='panel de control del docente'){

			echo '
			<h1>PANEL DE CONTROL DE LA MATERIA: '.$_SESSION['materia'].' GRUPO: '.$_SESSION['grupo_materia'].'</h1>
			<input type="button" onclick="location.href = ' ."'". "actualizar_variable_de_pagina_e_ir.php?pagina=estudiantes del docente" ."'". ' " value="Estudiantes" />
			<input type="button" onclick="location.href = ' ."'". "actualizar_variable_de_pagina_e_ir.php?pagina=bitacora del docente" ."'". ' " value="Bitacora" />
			<input type="button" onclick="location.href = ' ."'". "actualizar_variable_de_pagina_e_ir.php?pagina=evaluaciones del docente" ."'". ' " value="Evaluaciones" />
			<input type="button" onclick="location.href = ' ."'". "actualizar_variable_de_pagina_e_ir.php?pagina=evaluaciones del docente" ."'". ' " value="Cambiar Contrasena" />
			';

			}



						if($_SESSION['pagina']=='estudiantes del docente'){

						echo '
						<h1>ESTUDIANTES DE LA MATERIA '.$_SESSION['materia'].'</h1>
						';

				$result = mysqli_query($conectador,"select u.nombre, u.apellido from usuario u, materia_usuario mu where u.rol='estudiante' and mu.userName=u.userName and mu.id_materia = ".$_SESSION['id_materia'].";"); 
				if ($row = mysqli_fetch_array($result)){ 
					 echo "<table>"; 
					 echo "<tr><td>Nombre</td><td>Apellido</td></tr>"; 
					 do {							
					 		echo '
							<tr><td>'.$row[0].'</td><td>'.$row[1].'</td></tr>
					 		';

					 } while ($row = mysqli_fetch_array($result)); 
					 echo "</table>"; 
				}
				else {echo "No hay estudiantes en esta materia!";}

						}

						

						if($_SESSION['pagina']=='bitacora del docente'){

						echo '
						<h1>BITACORA DE LA MATERIA '.$_SESSION['materia'].'</h1>
						';

				//Muestreo de datos de los docentes del panel de control del administrador
				$result = mysqli_query($conectador,"select * from bitacora where id_materia = '".$_SESSION['id_materia']."';"); 
				if ($row = mysqli_fetch_array($result)){ 
					 echo "<table>"; 
					 echo "<tr><td>ID Materia</td><td>Responsable</td><td>Fecha</td><td>detalle</td></tr>"; 
					 do {							
					 		echo '
							<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td></tr>
					 		';

					 } while ($row = mysqli_fetch_array($result)); 
					 echo "</table>"; 
				}
				else {echo "No hay nada en la bitacora!";}

						}


				


						if($_SESSION['pagina']=='evaluaciones del docente'){

						echo '
						<h1>EVALUACIONES DE LA MATERIA: '.$_SESSION['materia'].' GRUPO: '.$_SESSION['grupo_materia'].'</h1>
						
						<div class="ancho page1_header"><a href = "actualizar_variable_de_pagina_e_ir.php?pagina=crear preguntas" class="banner">Nueva evaluación</a></div>
						';

						}


									if($_SESSION['pagina']=='crear preguntas'){

									echo '
									<h1>CREAR EVALUACIÓN: PASO 1</h1>
									<h1>CREAR PREGUNTAS:</h1>		

									        <table>
									            <tr><td>Pregunta</td><td>Tipo</td><td>Caracteristica</td></tr>
											    <tr>
											        <td><input type="text" name="" id="comUser" placeholder="Coloca tu pregunta"></td>
											        <td><select name="tipo" id="tipo">
											                <option onclick="abierta()">Abierta</option>
											                <option onclick="cerrada()">Cerrada</option>
											                <option onclick="estructurada()">Estructurada</option>
											            </select></td>
											        <td><div id="caracteristica"></div></td>
											    </tr>									      
								            </table>
									          <input type="button" onclick="enviarPregunta()" class="btn btn-default" value="Añadir" />									                  
									    <div id="zonaPregunta"></div>
									    <input type="button" onclick="enviarPreguntas()" class="btn btn-default" value="Continuar" />							
									';

									}








if($_SESSION['pagina']=='materias del estudiante'){

echo '
<h1>MATERIAS DEL ESTUDIANTE</h1>
<input type="button" onclick="location.href = ' ."'". "actualizar_variable_de_pagina_e_ir.php?pagina=panel de control del estudiante" ."'". ' " value="Matematicas" />
';

}


			if($_SESSION['pagina']=='panel de control del estudiante'){

			echo '
			<h1>PANEL DE CONTROL DEL ESTUDIANTE</h1>
			<input type="button" onclick="location.href = ' ."'". "actualizar_variable_de_pagina_e_ir.php?pagina=evaluaciones del estudiante" ."'". ' " value="Evaluaciones" />
			';

			}

						if($_SESSION['pagina']=='evaluaciones del estudiante'){

						echo '
						<h1>EVALUACIONES HECHAS O POR HACER</h1>
						<input type="button" onclick="location.href = ' ."'". "actualizar_variable_de_pagina_e_ir.php?pagina=pagina para resolver examen" ."'". ' " value="Resolver" />
						';

						}


?>

</body>
</html>

<script>
	
	function procLogin(){
      var userName = document.getElementById("userName").value;
      var password = document.getElementById("password").value;        
      if(userName != "" && password != ""){
      	location.href="procLogin.php?userName="+userName+"&password="+password+"";
      }
      else{
        alert("Datos incompletos");
      }   
    }

    function cambiaColor(){
    var i
    for (i=0;i<document.fcolores.colorin.length;i++){
       if (document.fcolores.colorin[i].checked)
          break;
    }
    document.bgColor = document.fcolores.colorin[i].value
    location.href="procCambiarColor.php?colorFondo="+colorin[i]+"";
	} 

    function abierta() {
    document.getElementById('caracteristica').innerHTML = '';
    tipo = "abierta";
    }
    function cerrada() {
    document.getElementById('caracteristica').innerHTML = '<a href="#opciones" class="portfolio-link" data-toggle="modal">Respuestas</a>';      
    tipo = "cerrada";
    }
    function estructurada() {
    document.getElementById('caracteristica').innerHTML = '<input name="" id="pasos" type="text" placeholder="Numero de pasos" />';
    tipo = "estructurada";
    }
   
</script>
