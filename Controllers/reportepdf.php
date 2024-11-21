<?php
set_time_limit(0);
date_default_timezone_set('America/Mexico_City');



genera_pdf();


function genera_pdf(){
 
//  include('../libs/archivos_fac/phpqrcode/generadorQR.php');
 require '../Models/model.cliente.php';

 $GuiaObj = new Cliente();

$id_pdf = $_REQUEST['id'];


$factura_relacionada = "";


$GuiaObj->set('id', $id_pdf);

$ope="";

foreach ($GuiaObj->listamensajeria2() as $guiaData) {
  $id  =   $guiaData["id"];
  $formato = $guiaData['fecha'];
  $fecha = date('d-m-Y H:i:s', strtotime($formato));
  $solicitud      =   $guiaData["tipo_solicitud"];
  $descripcion   =   $guiaData["descripcion"];

  $contacto   =   $guiaData["contacto"];
  $telefono   =   $guiaData["telefono"];
  $diligencia   =   $guiaData["diligencia"];
  $observaciones   =   $guiaData["observaciones"];
  // $estatus =  $guiaData["estatus"];

 
}


 $style='<style>
 table,
 .table1
 {
     
   font-family: arial;
 }
 
  body {
    font-size: 13px;
  }
  table {
      width: 100%;
      border-collapse: collapse;
      font-size: 13px;
  }
  th, td {
      padding: 8px;
      text-align: left;
       /* Añadir borde negro de 1px */
  }
  th {
      background-color:#00e7eb;
      color: white;
      text-align: center; /* centrar el texto */
  }
  tr:nth-child(2) th {
      background-color: #D3D3D3;
      color:black;
  }
  tr:nth-child(3) {
      background-color: #FFFFFF;
  }
 
  .blue {
      background-color:black; /* Color de fondo azul */
      color: white; /* Texto blanco */
      border: 1px solid rgb(97, 95, 95);
      width: 20%;
    font-size: 13px;
 
 
  }
  .white {
      background-color: #FFFFFF; /* Color de fondo blanco */
      color: black; /* Texto negro */
      border: 1px solid rgb(97, 95, 95);
    font-size: 13px;
 
 
  }
  .white22 {
   
    color: white
   


}
  .white1 {
      background-color: #FFFFFF; /* Color de fondo blanco */
      color: black; /* Texto negro */
  }
  .borde {
border-collapse: collapse;
}
 </style>
';




$html ='<body>';

 
    $cabecera ='<div style="width: 100%;  border-bottom: 0px solid #ccc;">
          
    <div style="width: 70%; border: 0px solid #ccc; border-radius:2pt; padding: 0pt; float: left;">
      <table style="border: 0px solid #000; border-collapse: collapse" width="100%" >
       <tr>
         <td >&nbsp;&nbsp;&nbsp;&nbsp;
            <img src="../img/L_MAKICOP.png" width="200px;" border=0>
         </td>

         <td>
           <div style="font-size:10px; color: #505050">
             <p style="font-size:12px"><b style="color: #505050">&nbsp;</b><p>
             <BR>
             <p class="white22"><b >FOLIO:  </b></p>
             <p class="white22">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R.F.C <b style="color: #505050"></b></p>
             <p>&nbsp;&nbsp;&nbsp;&nbsp;</p>
             <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
             <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
             
           </div>
         </td>
       </tr>
       <tr><br><br> <td >
        <b >SOLICITUD DE MENSAJERIA</b> 
     </td></tr>
     <tr> <td    align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      
   </td></tr>
     </table>
   </div>';
 
       $cabecera .='
       <div style="width: 25%; border: 0px solid #ccc; border-radius:2pt; padding: 0pt; float: right;">
           <div style="border: 1px solid white; border-radius:2pt; width: 100%; border-collapse: collapse" >
            <br>    <br>
             <table width="100%" style="border-collapse: collapse">
               
               
             <tr><th class="white">FECHA</th><td></td></tr>
             <tr>
             <th  class="white" align="center" style=" padding: 3px">
                    <p align="center" style="font-size:14px; "><b style="color:#000000" >'.$fecha.'</b></p>
               </th></tr>
               <tr><td ></td><td></td></tr>
               <tr>
               <th  class="white" align="center" style=" padding: 3px">
                      <p align="center" style="font-size:14px; "><b style="color:#000000" >FOLIO: '.$id.'</b></p>
                 </th></tr>
                 
             </table>
           </div>
       </div>
 
   </div>
   ';
  
 $cabecera .=' <table class="table white">
 <thead>
   <tr>
     <th colspan="5" style="background-color: #72A0CA; color:black " scope="row" >DATOS GENERALES</th>
    
   </tr>
   <tr>
   <td colspan="5"  scope="col"></td>
  
 </tr>
 </thead>
 <tbody>
   <tr>
     <td style="width:5%;"></td>
     <th style="width:22%;" class="white" scope="row"><b>TIPO DE SOLICITUD</b></th>
     <td colspan="2" style="width:75%;" class="white">'.$solicitud.'</td>
     
     <td style="width:10%;"></td>
   </tr>
   <tr>
   <td colspan="4"  scope="col"></td>
  
 </tr>
   <tr>
   <td style="width:5%;"></td>
     <th  class="white"><b>CONTACTO:</b></th>
     <td  colspan="2" class="white">'.$contacto.'    </td>
     
     <td style="width:10%;"></td>
   </tr>
   <tr>
   <td colspan="4"  scope="col"></td>
  
 </tr>
   <tr>
   <td style="width:5%;"></td>
     <th  class="white"><b>TELEFONO:</b></th>
     <td  colspan="2" class="white">'.$telefono.'</td>
     
     <td style="width:10%;"></td>
   </tr>
   <tr>
   <td colspan="5"  scope="col"></td>
  
 </tr>
   <tr>
     <th class="white" style=" background-color: #72A0CA;" colspan="5" scope="row">DESCRIPCIÓN</th>
    
   </tr>
   
   <tr>
     <td colspan="5" class="white" scope="row">'.$descripcion.'<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></td>
     
   </tr>
  
   
 </tbody>
     


    
 ';  
  

 
    $cabecera.='</table>
    ';
     
    $cabecera .=' 
    <table class="white">
      <thead>
      <tr>
      <td colspan="5"  scope="col"></td>
        
      </tr>
        <tr>
        <td style="width:5%;"></td>
          <th scope="col" class="white"  style="width:28% background-color: #72A0CA; ">DILIGENCIA REALIZADA POR:</th>
          <td scope="col" class="white" colspan="2">'.$diligencia.'</td>
          <td style="width:10%;"></td>
        </tr>
      </thead>
      <tbody>
        <tr>
        <td colspan="5"  scope="col"></td>
          
        </tr>
        <tr>
          <th scope="row" class="white" style=" background-color: #72A0CA;" colspan="2">RECIBIDO FIRMADO Y SELLADO</th>
          
          <th colspan="3" style=" background-color: #72A0CA;" class="white">OBSERVACIONES</th>
          
        </tr>
        <tr>
          <th colspan="2" class="white"   rowspan="7" scope="row"><br><br><br><br><br><br><br><br><br><br><br><br><br><br></th>
          
          <td rowspan="7" colspan="3" class="white" >'.$observaciones.'<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></td>
        </tr>
        
      
      </tbody><br>
      </table>';

    
 


 $html .='</body>';

 $html = mb_convert_encoding($html, 'utf-8', 'utf8');
 $style = mb_convert_encoding($style, 'utf-8', 'utf8');
 $cabecera = mb_convert_encoding($cabecera, 'utf-8', 'utf8');
          include("../libs/MPDF/Mpdf.php");
          $mpdf=new Mpdf('utf-8' , 'A4','', 4, 4, 4, 93, 12, 4);
         
          $footer = "<table name='footer' width=\"1000\">
                     <tr>
                     <td style='font-size: 13px;color: #505050' align=\"left\">MAKICOP MENSAJERIA</td><br>
                     <td style='font-size: 13px;color: #505050' align=\"center\">DOCUMENTO INTERNO</td><br>
                     <td style='font-size: 13px;color: #505050' align=\"right\">Página {PAGENO} de {nbpg} </td>
                       </tr>
                   </table>";
         $mpdf->SetHTMLHeader($cabecera);
         $mpdf->SetFooter($footer);
         $mpdf->WriteHTML($style);
         $mpdf->WriteHTML($html);
         $mpdf->WriteHTML($qr);
         
         $titulo="Makicop_mensajeria: ";
         
         $mpdf->Output("../PDF/".$id_pdf.".pdf");
         
          // $mpdf->Output();
         
         
        
    }
        ?>   