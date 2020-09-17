<?php

//include("config/config.php");
include("data/login_data.php"); 

$sql1 = 'select * from escollan_software2.admin where username = "'.$_SESSION['login_user'].'"';
//echo $sql1 . "<br>";
$sth1=FETCH_SQL($sql1);
while($result1 = $sth1->fetch(PDO::FETCH_OBJ)){
  $rol=$result1->rol;
  $nombres_usuario=$result1->nombres;
}






  





$contador=0;
$tabla = '<table class="table table-hover">
<thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Fecha</th>
        <th scope="col">Hora</th>
        <th scope="col">Eliminar</th>
    </tr>
</thead>
    <tbody>';

	/////////////////////////////////////////////////////////////////////////lista de planificación de médicos ingresados//////////////////////////////////////////////////////////////
	$sql3 = 'select * from citas where cedula = "'.$_SESSION['login_user'].'"';
//  
	//echo $sql3;
	$sth3=FETCH_SQL($sql3);
	while($result3 = $sth3->fetch(PDO::FETCH_OBJ)){
        $contador=$contador+1;
        $id=$result3->id;
        $fecha=$result3->fecha;
        $hora=$result3->hora;

         
	$tabla .= '
    <tr>
        <th scope="row">'.$contador.'</th>
        <td>
            <button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModal'.$id.'">
            '.$fecha.'
            </button>        
        </td>
        <td>'.$hora.'</td>
        <td>
            <button type="button" class="btn btn-light" data-toggle="modal" data-target="#eliminar'.$id.'">
                 Eliminar
            </button>        
        </td>
    </tr>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal'.$id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reprogramar Cita: '.$fecha.' '.$hora.' </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form  method="post" action="reprogramar.php">  
                <div class="modal-body">                          
                    <form id="wrapped" method="POST" action="crear_cita.php">
                    <div class="form-group">
                        <input type="date" name="fecha" class="form-control required"
                            placeholder="Seleccione una fecha">
                    </div>
                    <div class="form-group">
                        <input type="time" name="hora" class="form-control required" placeholder="Seleccione una fecha">
                    </div>     
                    <button type="submit" class="submit">Continuar</button>             

                    </form>
                                     
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Reprogramar</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    <div class="modal fade" id="eliminar'.$id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Cita: '.$fecha.' '.$hora.' </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form  method="post" action="eliminar.php">  
                <div class="modal-body">                          
                       Realmente desea eliminar la cita?
                       <input type="hidden" value="'.$id.'" name="idcita">
                                     
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    ';
			
    }
    

  $tabla .=  '</tbody></table>';

  //echo $id;

  if ($id==""){
    $boton_continuar='<button type="submit" class="submit">Continuar</button>';
    
  }
  else{
    $boton_continuar='';

  }

 
$html = file_get_contents("cita.html");
$html = str_replace("{tabla}",$tabla,$html);

$html = str_replace("{rol}",$rol,$html);
$html = str_replace("{boton_continuar}",$boton_continuar,$html);
$html = str_replace("{nombres_usuario}",$nombres_usuario,$html);
$html = str_replace("{cedula}",$_SESSION['login_user'],$html);


echo $html;
?>
