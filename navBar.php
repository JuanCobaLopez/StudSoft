<?php

if($_SESSION['rol']=='administrador'){
echo '
<div class="ancho page1_header"><a href = "actualizar_variable_de_pagina_e_ir.php?pagina=panel de control del administrador" class="banner">Inicio</a></div>
';
}
if($_SESSION['rol']=='docente'){
echo '
<div class="ancho page1_header"><a href = "actualizar_variable_de_pagina_e_ir.php?pagina=materias del docente" class="banner">Inicio</a></div>
<div class="ancho page1_header"><a href = "actualizar_variable_de_pagina_e_ir.php?pagina=perfil" class="banner">Mi Perfil</a></div>
';
}
if($_SESSION['rol']=='estudiante'){
echo '
<div class="ancho page1_header"><a href = "actualizar_variable_de_pagina_e_ir.php?pagina=panel de control del estudiante" class="banner">Inicio</a></div>
<div class="ancho page1_header"><a href = "actualizar_variable_de_pagina_e_ir.php?pagina=perfil" class="banner">Mi perfil</a></div>
';
}

echo '
	<div class="ancho page1_header"><a href = "sessionDestroy.php" class="banner">Salir</a></div>
	';

echo '<br>';

?>