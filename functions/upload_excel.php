<?php 
	
	session_start();
	if ($_SESSION['user'] == "") {
		
		header("Location: index.php");
	}
	
	include '../config.php';

	$mensaje 	=	"";// Mensaje de respuesta
	$date 		=	date('Y-m-d'); // Fecha actual
	
	// Verifica que se selecciono un archivo
	if(isset($_FILES['file_xls']['name']))
    {
		$upload_dir = '../xls/';
        $upload_file = $upload_dir . $date . "_" . basename($_FILES['file_xls']['name']);
        if (move_uploaded_file($_FILES['file_xls']['tmp_name'], $upload_file)) {
            //El archivo es válido y se subió con éxito
			//
			//Aca lee datos de excel y los registra en la bd
            require_once('../Classes/PHPExcel.php'); //Carga de la Libreria para trabaja con excel
            $objPHPExcel = PHPExcel_IOFactory::load($upload_file); //Aca lee el archivo excel
            $xls_wholesale_price =	array('I','J','K'); //contien las tres columnas de precios
            $type_price = 1; //para la equivalencia de los tipos de precios (1:A 2:B 3:C) fungira como contador

			//Variables para capturar los valores del excel
			$value_upccode='';
			$value_image ='';
			$value_description = '';
			$value_retail_price = 0;
			$value_synchronized = 0; //Por defecto
			$value_category_name = '';
			//Hasta aqui

            // Borra los registros de la tabla product de oasis que no son extra products
    		$sql 	= 	"DELETE FROM product WHERE is_extraproduct = 0";
		  	$query 	=	$mysqli->query($sql);


			//Recorre el archivo excel
			foreach ($objPHPExcel->getActiveSheet()->getRowIterator() as $row) {
			    //Si la fila es visible (no esta filtrada)
			    if ($objPHPExcel->getActiveSheet()->getRowDimension($row->getRowIndex())->getVisible() == true and $objPHPExcel-> getActiveSheet()->getCell('B'.$row->getRowIndex())->getValue() != "prodid") {

			               
			        //Recorrido por las tres comulna de precios (aprice,bprice,cprice)
			       for ($type_price=1; $type_price <= 3; $type_price++) { 
			        	//
			        	$value_upccode =  $objPHPExcel->getActiveSheet()->getCell('B'.$row->getRowIndex())->getValue();
			            $value_image = $objPHPExcel->getActiveSheet()->getCell('D'.$row->getRowIndex())->getFormattedValue();
			            $value_description = $objPHPExcel->getActiveSheet()->getCell('E'.$row->getRowIndex())->getValue();
			            $value_retail_price = str_replace(",",".",$objPHPExcel->getActiveSheet()->getCell('G'.$row->getRowIndex())->getValue());
			            $value_wholesale_price = $objPHPExcel->getActiveSheet()->getCell($xls_wholesale_price[$type_price-1] . $row->getRowIndex())->getValue();
			            $value_category_name = $objPHPExcel->getActiveSheet()->getCell('L'.$row->getRowIndex())->getValue();
			            $value_quantity = $objPHPExcel->getActiveSheet()->getCell('F'.$row->getRowIndex())->getValue();
			            $value_long_desc = $objPHPExcel->getActiveSheet()->getCell('M'.$row->getRowIndex())->getValue();
			            //
			            //Busca en la base de datos si el producto existe segun el upc_code y el tipo de precio
			        	$product_query=$mysqli->query("select * from product where upc_code='". $value_upccode ."' AND type=" . $type_price) or die($mysqli->error);
			        	$data=mysqli_fetch_assoc($product_query);
			            //Si no existe hace el insert
			            if (!$data) {
			               
			               $sql_insert = "INSERT INTO product (image, description, retail_price, wholesale_price, type,upc_code, synchronized, category, quantity, long_description) 
			               VALUES ('". $value_image."','".$value_description."',".$value_retail_price.",".$value_wholesale_price.",".$type_price.",'".$value_upccode."',".$value_synchronized.",'".$value_category_name."',".$value_quantity.",'".$value_long_desc."')";
			               $action_query = $mysqli->query($sql_insert);
			               

			            }
			            else //Hace el update
			            {

			               $sql_update = "UPDATE product SET image ='".$value_image. "', description ='" .$value_description."',retail_price = ".$value_retail_price.",
			                                     wholesale_price = ". $value_wholesale_price.",type = ".$type_price.",upc_code= '".$value_upccode."',synchronized = ".$value_synchronized.",category='".$value_category_name."'
			                              , quantity = ".$value_quantity. ", long_description ='".$value_long_desc."' WHERE upc_code='". $value_upccode ."' AND type=" . $type_price;

			               $action_query = $mysqli->query($sql_update);

			            }

			        } 

			    }
			}
			//
			$mensaje 	= 	0;
			unset($objPHPExcel);
        } 
		else 
		{
         //No se cargo el archivo
		 $mensaje 	=  	1;
        }
	}
	else //No selecciono ningun archivo
	{
        $mensaje=1;
	}
	
	
	
	
	mysql_close($con); // Cierro la Base de datos


	header("Location: ../dashboard.php?p=excel&type=1&message=".$mensaje."");

	
?>