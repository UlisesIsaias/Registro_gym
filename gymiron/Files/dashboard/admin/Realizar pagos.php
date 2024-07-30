<?php
require '../../include/db_conn.php';
page_protect();
if (isset($_POST['userID']) && isset($_POST['planID'])) {
    $id_usuarioo  = $_POST['userID'];
    $id_plan=$_POST['planID'];
    $query1 = "select * from usuarios WHERE id_usuario='$id_usuarioo'";
    
    $result1 = mysqli_query($con, $query1);
    
    if (mysqli_affected_rows($con) == 1) {
        while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
            
            $name = $row1['nombre_usuario'];
            $query2="select * from planes where id_plan='$id_plan'";

            $result2=mysqli_query($con,$query2);
            if($result2){
               $planValue=mysqli_fetch_array($result2,MYSQLI_ASSOC);
               $planName=$planValue['nombre_plan'];
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>

    <title>Iron Gym | Hacer el pago</title>
     <link rel="stylesheet" href="../../css/style.css"  id="style-resource-5">
    <script type="text/javascript" src="../../js/Script.js"></script>
    <link rel="stylesheet" href="../../css/dashMain.css">
    <link rel="stylesheet" type="text/css" href="../../css/entypo.css">
    <link href="a1style.css" type="text/css" rel="stylesheet">
    <style>
    	.page-container .sidebar-menu #main-menu li#paymnt > a {
    	background-color: #2b303a;
    	color: #ffffff;
		}
	#boxx
	{
		width:220px;
	}
   </style>
</head>
   <body class="page-body  page-fade" onload="collapseSidebar()" style="background-color: #ff0000;">

    	<div class="page-container sidebar-collapsed" id="navbarcollapse">	
	
		<div class="sidebar-menu">
	
			<header class="logo-env">
			
			<!-- logo -->
			<div class="logo">
				<a href="main.php">
					<img src="../../images/iron.png" alt="" width="192" height="80" />
				</a>
			</div>
			
					<!-- icono de colapso del logotipo -->
					<div class="sidebar-collapse" onclick="collapseSidebar()">
				<a href="#" class="sidebar-collapse-icon with-animation">
					 <!-- agregue la clase "con animación" si desea que la barra lateral 
					tenga animación durante la transición de expandir/contraer -->
					<i class="entypo-menu"></i>
				</a>
			</div>
							
			
		
			</header>
    		<?php include('nav.php'); ?>
    	</div>


    		<div class="main-content">
		
				<div class="row">
					
					<!-- Información de perfil y notificaciones -->
					<div class="col-md-6 col-sm-8 clearfix">	
							
					</div>
					
					
					<!-- Enlaces sin procesar -->
					<div class="col-md-6 col-sm-4 clearfix hidden-xs">
						
						<ul class="list-inline links-list pull-right">

							<li>Bienvenido <?php echo $_SESSION['nombre_usuario']; ?> 
							</li>								
						
							<li>
								<a href="cerrar sesión.php">
									Cerrar Sesión <i class="entypo-logout right"></i>
								</a>
							</li>
						</ul>
						
					</div>
					
				</div>

		<h3>Iron Gym</h3>

		<hr />

		
		
		
		
		
		<div class="a1-container a1-small a1-padding-32" style="margin-top:2px; margin-bottom:2px;">
        <div class="a1-card-8 a1-light-gray" style="width:500px; margin:0 auto;">
		<div class="a1-container a1-dark-gray a1-center">
        	<h6>Hacer el Pago</h6>
        </div>
       <form id="form1" name="form1" method="post" class="a1-container" action="enviar pagos.php">
         <table width="100%" border="0" align="center">
         <tr>
           <td height="35"><table width="100%" border="0" align="center">
           	 <tr>
           	   <td height="35">ID Membresia:</td>
           	   <td height="35"><input type="text" name="m_id" id="boxx" value="<?php echo $id_usuarioo; ?>" readonly/></td>
         	   </tr>
			   
			   <tr>
               <td height="35">Nombre:</td>
               <td height="35"><input type="text" name="u_name" id="boxx" value="<?php echo $name; ?>" placeholder="Nombre de la Membresia" maxlength="30" readonly/>
                 
             </tr>
             <tr>
               <td height="35">PLAN ACTUAL</td>
               <td height="35"><input type="text" name="prevPlan" id="boxx" value="<?php echo $planName; ?>" readonly></td></td>
             </tr>
             <tr>
               <td height="35">Selecciona el Nuevo Plan:</td>
               <td height="35"><select name="plan" id="boxx" required onchange="myplandetail(this.value)">
							<option value="">-- por favor selecciona --</option>
							<?php
    
							    $query = "select * from planes where activo='si'";
							    
							    //echo $query;
							    $result = mysqli_query($con, $query);
							    
							    if (mysqli_affected_rows($con) != 0) {
							        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							            echo "<option value=" . $row['id_plan'] . ">" . $row['nombre_plan'] . "</option>";
							            
							        }
							    }
							    
							?>
						</select></td></td>
             </tr>
             
		   
            
             <tr>
			  <table id="plandetls">
             </table>
			 
            
           </table></td>
		   
         </tr>
		  <tr>
               <td height="35">&nbsp;</td>
               <td height="35">&ensp;&ensp;&ensp;&ensp;&ensp;&ensp; &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp; &ensp;&ensp;&ensp;&ensp;&ensp; &ensp;&ensp;&ensp;&ensp;&ensp;&ensp; <input class="a1-btn a1-blue" type="submit" name="submit" id="submit" value="Pago Añadido" >
                 <input class="a1-btn a1-blue" type="reset" name="reset" id="reset" value="Reiniciar"></td>
             </tr>
         </table>
       </form>
    </div>
    </div>   
		
		
		
		

		<?php include('pie_pagina.php'); ?>

		</div>


    </body>
</html>


 <script>
        	function myplandetail(str){

        		if(str==""){
        			document.getElementById("plandetls").innerHTML = "";
        			return;
        		}else{
        			if (window.XMLHttpRequest) {
           		 // code for IE7+, Firefox, Chrome, Opera, Safari
           			 xmlhttp = new XMLHttpRequest();
       				 }
       			 	xmlhttp.onreadystatechange = function() {
            		if (this.readyState == 4 && this.status == 200) {
               		 document.getElementById("plandetls").innerHTML=this.responseText;
                
            			}
        			};
        			
       				 xmlhttp.open("GET","infoplan.php?q="+str,true);
       				 xmlhttp.send();	
        		}
        		
        	}
        </script>

<?php
} 
?>
