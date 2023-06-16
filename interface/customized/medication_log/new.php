<?php
   require_once(__DIR__ . "/../../globals.php");
   require_once("$srcdir/api.inc");
   require_once("$srcdir/patient.inc");
   require_once("$srcdir/options.inc.php");
   
   use OpenEMR\Common\Csrf\CsrfUtils;
   use OpenEMR\Core\Header;
   
   $returnurl = 'encounter_top.php';
   $formid = 0 + (isset($_GET['id']) ? $_GET['id'] : 0);
   if ($formid) {
       $sql = "SELECT * FROM `form_medication_log` WHERE id=? AND pid = ? AND encounter = ?";
       $res = sqlStatement($sql, array($formid,$_SESSION["pid"], $_SESSION["encounter"]));
       for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
           $all[$iter] = $row;
       }
       $check_res = $all[0];
   }
   //echo $formid;
   $check_res = $formid ? $check_res : array();

   $select2=explode(",",$check_res['select2']);
   // print_r($check_res);
   // die;
   
   $sql1="SELECT * FROM `patient_data` WHERE  pid = ?";
   
   $res1 = sqlStatement($sql1, array($_SESSION["pid"]));
   
   for ($iter1 = 0; $row1 = sqlFetchArray($res1); $iter1++) {
     $all1[$iter1] = $row1;
   }
   $check_res1 = $all1[0];
   $session_name = trim($check_res1['fname'] . ' ' . $check_res1['lname']);
   $session_add=$check_res1['street'].','.$check_res1['city'].','.$check_res1['state'].','.$check_res1['country_code'].','.$check_res1['postal_code'];

   ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Ntherapy</title>
      <?php Header::setupHeader(); ?>
        <link rel="stylesheet" href=" ../../forms/admission_orders/assets/css/jquery.signature.css">
      <!-- Latest compiled and minified CSS -->
      <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
      <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script> -->
      <style type="text/css">

td{
    border: 1px solid black;
    font-size: 13px;
  }
  b#b1 {
    float: right;
    font-size: 10px;
    margin-right: 350px;
    margin-top: 10px;
  }
  .parent{
    display: flex;
  }
  .parent input{
    border: 0;
    outline: 0;
    border-bottom: 1px solid black;
  }
  .inp{
    border: 0;
    outline: 0;
    border-bottom: 1px solid black;
  }
  ul {
  list-style-type: none;
}

input {
    width: 25%;
}
.tbl2 input{
  width: 100%;
}
.btndiv {
         text-align: center;
         margin-bottom: 18px;
         }
         .subbtn {
         background: blue;
         color: white;
         }
         button.cancel {
         background: red;
         color: white;
         }
         input.inp {
    width: 35%;
}
          </style>
</head>
<body>
    <div class="container mt-3">
    <div class="row">
      <div class="container-fluid">
        <br>
        <form method="post" name="my_form1" action="<?php echo $rootdir; ?>/forms/medication_log/save.php?id=<?php echo attr_url($formid); ?>">
        <table style="width:100%;">
        <table style="width:100%;">
          <tr>
          <td style="width:100%;">
            <b>Medication Log</b>
            <b id="b1">PRN MEDICATIONS</b>
          </td></tr>
          </table>
          <table style="width:100%;">
                    <tr>
          <td style="width:30%;">
            <b>Patient Name:<input type="text" name="inp154" value="<?php echo $check_res['inp154'];?>" class="inp"></b>
          </td>
          <td style="width:30%;">
            <b>DOB:<input type="date" name="inp155" value="<?php echo $check_res['inp155'];?>" class="inp"></b>
          </td>
          <td style="width:30%;">
            <b>Allergies:<input type="text" name="inp156" value="<?php echo $check_res['inp156'];?>" class="inp"></b>
          </td>
        </tr>
        </table>
        <table style="width:100%;" class="tbl2">
          <tr>
            <td style="width:20%;">
              <b>Medication,Dose,Frequency & Route</b>
              
            </td>
             <td>
              Date/Time/RN Initials(Site for IM Injection)
              
            </td>   
                     <td>
                      Patient
                      Initials
              
            </td>          
              <td>
              Date/Time/RN Initials(Site for IM Injection)
            </td>         
               <td>
               Patient
                      Initials
            </td>           
             <td>
              Date/Time/RN Initials(Site for IM Injection)
            </td>          
              <td>
              Patient
                      Initials
            </td>           
             <td>
               Date/Time/RN Initials(Site for IM Injection)
            </td>            
            <td>
              Patient
                      Initials
            </td>            
            <td>
              Date/Time/RN Initials(Site for IM Injection)
            </td>           
             <td>
              Patient
                      Initials
            </td>
          </tr>

                    <tr>
            <td style="width:20%;">
              Motrin 600mg PO Q $hours, PRN Discomfort,<br>
Max 4 doses per 24 hrs.
              
            </td>
             <td>
              
              <input type="text" name="inp1" value="<?php echo $check_res['inp1'];?>">
            </td>   
            <td>
                      
              <input type="text" name="inp2" value="<?php echo $check_res['inp2'];?>">
            </td>          
              <td>
             <input type="text" name="inp3" value="<?php echo $check_res['inp3'];?>">
            </td>         
               <td>
               <input type="text" name="inp4" value="<?php echo $check_res['inp4'];?>">
            </td>           
             <td>
              <input type="text" name="inp5" value="<?php echo $check_res['inp5'];?>">
              <td>
             <input type="text" name="inp6" value="<?php echo $check_res['inp6'];?>">
            </td>           
             <td>
               <input type="text" name="inp7" value="<?php echo $check_res['inp7'];?>">
            </td>            
            <td>
              <input type="text" name="inp8" value="<?php echo $check_res['inp8'];?>">
            </td>            
            <td>
             <input type="text" name="inp9" value="<?php echo $check_res['inp9'];?>">
            </td>           
             <td>
              <input type="text" name="inp10" value="<?php echo $check_res['inp10'];?>">
            </td>
          </tr>
          
          <tr>
            <td style="width:20%;">
Tylenol 500mg PO Q 4 hours,PRN<br>
Headache/Fever(>than 101'F):Max 4 doses<br>
per 24hrs.
              
            </td>
             <td>
              <input type="text" name="inp11" value="<?php echo $check_res['inp11'];?>">
              
            </td>   
            <td>
                      
              <input type="text" name="inp12" value="<?php echo $check_res['inp12'];?>">
            </td>          
              <td>
             <input type="text" name="inp13" value="<?php echo $check_res['inp13'];?>">
            </td>         
               <td>
               <input type="text" name="inp14" value="<?php echo $check_res['inp14'];?>">
            </td>           
             <td>
              <input type="text" name="inp15" value="<?php echo $check_res['inp15'];?>">
              <td>
             <input type="text" name="inp16" value="<?php echo $check_res['inp16'];?>">
            </td>           
             <td>
               <input type="text" name="inp17" value="<?php echo $check_res['inp17'];?>">
            </td>            
            <td>
              <input type="text" name="inp18" value="<?php echo $check_res['inp18'];?>" >
            </td>            
            <td>
             <input type="text" name="inp19" value="<?php echo $check_res['inp19'];?>">
            </td>           
             <td>
              <input type="text" name="inp20" value="<?php echo $check_res['inp20'];?>">
            </td>
          </tr>

          <tr>
            <td style="width:20%;">
Reglan 10mg IM Q6 PRN for Nausea Max 4 <br>
doses in 24hrs
              
            </td>
             <td>
              <input type="text" name="inp21" value="<?php echo $check_res['inp21'];?>">
              
            </td>   
            <td>
                      
              <input type="text" name="inp22" value="<?php echo $check_res['inp22'];?>">
            </td>          
              <td>
             <input type="text" name="inp23" value="<?php echo $check_res['inp23'];?>">
            </td>         
               <td>
               <input type="text" name="inp24" value="<?php echo $check_res['inp24'];?>">
            </td>           
             <td>
              <input type="text" name="inp25" value="<?php echo $check_res['inp25'];?>">
              <td>
             <input type="text" name="inp26" value="<?php echo $check_res['inp26'];?>">
            </td>           
             <td>
               <input type="text" name="inp27" value="<?php echo $check_res['inp27'];?>">
            </td>            
            <td>
              <input type="text" name="inp28" value="<?php echo $check_res['inp28'];?>">
            </td>            
            <td>
             <input type="text" name="inp29" value="<?php echo $check_res['inp29'];?>">
            </td>           
             <td>
              <input type="text" name="inp30" value="<?php echo $check_res['inp30'];?>">
            </td>
          </tr>

          <tr>

            <td style="width:20%;">
Reglan 15mg PO Q 1 hour, PRN GI Distress<br>
Max 8 doses per 24hrs.
              
            </td>
             <td>
              <input type="text" name="inp31" value="<?php echo $check_res['inp30'];?>">
              
            </td>   
            <td>
                      
              <input type="text" name="inp32" value="<?php echo $check_res['inp32'];?>">
            </td>          
              <td>
             <input type="text" name="inp33" value="<?php echo $check_res['inp33'];?>">
            </td>         
               <td>
               <input type="text" name="inp34" value="<?php echo $check_res['inp34'];?>">
            </td>           
             <td>
              <input type="text" name="inp35" value="<?php echo $check_res['inp35'];?>">
              <td>
             <input type="text" name="inp36" value="<?php echo $check_res['inp36'];?>">
            </td>           
             <td>
               <input type="text" name="inp37" value="<?php echo $check_res['inp37'];?>">
            </td>            
            <td>
              <input type="text" name="inp38" value="<?php echo $check_res['inp38'];?>">
            </td>            
            <td>
             <input type="text" name="inp39" value="<?php echo $check_res['inp39'];?>">
            </td>           
             <td>
              <input type="text" name="inp40" value="<?php echo $check_res['inp40'];?>">
            </td>
          </tr>

          <tr>
            <td style="width:20%;">
              Maalox 30ml PO Q 1hour, PRN GI Distress,<br>
Max 8 doses per 24hrs.
              
            </td>
             <td>
              <input type="text" name="inp41" value="<?php echo $check_res['inp41'];?>">
              
            </td>   
            <td>
               <input type="text" name="inp42" value="<?php echo $check_res['inp42'];?>">       
              
            </td>          
              <td>
             <input type="text" name="inp43" value="<?php echo $check_res['inp43'];?>">
            </td>         
               <td>
               <input type="text" name="inp44" value="<?php echo $check_res['inp44'];?>">
            </td>           
             <td>
              <input type="text" name="inp45" value="<?php echo $check_res['inp45'];?>">
              <td>
             <input type="text" name="inp46" value="<?php echo $check_res['inp46'];?>">
            </td>           
             <td>
               <input type="text" name="inp47" value="<?php echo $check_res['inp47'];?>">
            </td>            
            <td>
              <input type="text" name="inp48" value="<?php echo $check_res['inp48'];?>">
            </td>            
            <td>
             <input type="text" name="inp49" value="<?php echo $check_res['inp49'];?>">
            </td>           
             <td>
              <input type="text" name="inp50" value="<?php echo $check_res['inp50'];?>">
            </td>
          </tr>


          <tr>
            <td style="width:20%;">
             Robaxin 750mg PO Q 4 hours, PRN Muscle<br>
Spasms, Max 3 doses per 24hrs.
              
            </td>
             <td>
              
              <input type="text" name="inp51" value="<?php echo $check_res['inp51'];?>">
            </td>   
            <td>
                      
              <input type="text" name="inp52" value="<?php echo $check_res['inp52'];?>">
            </td>          
              <td>
             <input type="text" name="inp53" value="<?php echo $check_res['inp53'];?>">
            </td>         
               <td>
               <input type="text" name="inp54" value="<?php echo $check_res['inp54'];?>">
            </td>           
             <td>
              <input type="text" name="inp55" value="<?php echo $check_res['inp55'];?>">
              <td>
             <input type="text" name="inp56" value="<?php echo $check_res['inp56'];?>">
            </td>           
             <td>
               <input type="text" name="inp57" value="<?php echo $check_res['inp57'];?>">
            </td>            
            <td>
              <input type="text" name="inp58" value="<?php echo $check_res['inp58'];?>">
            </td>            
            <td>
             <input type="text" name="inp59" value="<?php echo $check_res['inp59'];?>">
            </td>           
             <td>
              <input type="text" name="inp60" value="<?php echo $check_res['inp60'];?>">
            </td>
          </tr>


          <tr>
            <td style="width:20%;">
              Hydroxyzine Pamoate(Vistaril) 50mg PO Q 4<br>
hours,PRN Anxiety,<u>Max 3 doses per 24 <br>hours</u>for pt's<30yrs,<u>Max 2 doses per 24<br>hours</ul> for pt's 30-50 and <u>Max 1 dose per 24</ul><br> hours for adults >50 yrs x 10days.
              
            </td>
             <td>
              <input type="text" name="inp61" value="<?php echo $check_res['inp61'];?>">
              
            </td>   
            <td>
                 <input type="text" name="inp62" value="<?php echo $check_res['inp62'];?>">     
              
            </td>          
              <td>
             <input type="text" name="inp63" value="<?php echo $check_res['inp63'];?>">
            </td>         
               <td>
               <input type="text" name="inp64" value="<?php echo $check_res['inp64'];?>">
            </td>           
             <td>
              <input type="text" name="inp65" value="<?php echo $check_res['inp65'];?>">
              <td>
             <input type="text" name="inp66" value="<?php echo $check_res['inp66'];?>">
            </td>           
             <td>
               <input type="text" name="inp67" value="<?php echo $check_res['inp67'];?>">
            </td>            
            <td>
              <input type="text" name="inp68" value="<?php echo $check_res['inp68'];?>">
            </td>            
            <td>
             <input type="text" name="inp69" value="<?php echo $check_res['inp69'];?>">
            </td>           
             <td>
              <input type="text" name="inp70" value="<?php echo $check_res['inp70'];?>">
            </td>
          </tr>

          <tr>
            <td style="width:20%;">
              Imodioum 2 mg PO Q 2hours,PRN Diarrhea,<br>
Max 4 doses per 24hrs.
              
            </td>
             <td>
              <input type="text" name="inp71" value="<?php echo $check_res['inp71'];?>">
              
            </td>   
            <td>
                 <input type="text" name="inp72" value="<?php echo $check_res['inp72'];?>">     
              
            </td>          
              <td>
             <input type="text" name="inp73" value="<?php echo $check_res['inp73'];?>">
            </td>         
               <td>
               <input type="text" name="inp74" value="<?php echo $check_res['inp74'];?>">
            </td>           
             <td>
              <input type="text" name="inp75" value="<?php echo $check_res['inp75'];?>">
              <td>
             <input type="text" name="inp76" value="<?php echo $check_res['inp76'];?>">
            </td>           
             <td>
               <input type="text" name="inp77" value="<?php echo $check_res['inp77'];?>">
            </td>            
            <td>
              <input type="text" name="inp78" value="<?php echo $check_res['inp78'];?>">
            </td>            
            <td>
             <input type="text" name="inp79" value="<?php echo $check_res['inp79'];?>">
            </td>           
             <td>
              <input type="text" name="inp80" value="<?php echo $check_res['inp80'];?>">
            </td>
          </tr>

          <tr>
            <td style="width:20%;">
             MOM 30ml PO BID x 3days, PRN<br>
Constipation.
              
            </td>
             <td>
              <input type="text" name="inp81" value="<?php echo $check_res['inp81'];?>">
              
            </td>   
            <td>
                 <input type="text" name="inp82" value="<?php echo $check_res['inp82'];?>">     
              
            </td>          
              <td>
             <input type="text" name="inp83" value="<?php echo $check_res['inp83'];?>">
            </td>         
               <td>
               <input type="text" name="inp84" value="<?php echo $check_res['inp84'];?>">
            </td>           
             <td>
              <input type="text" name="inp85" value="<?php echo $check_res['inp85'];?>">
              
             
            </td>           
             <td>
               <input type="text" name="inp86" value="<?php echo $check_res['inp86'];?>">
            </td>            
            <td>
              <input type="text" name="inp87" value="<?php echo $check_res['inp87'];?>">
            </td>            
            <td>
             <input type="text" name="inp88" value="<?php echo $check_res['inp88'];?>">
            </td>           
             <td>
              <input type="text" name="inp89" value="<?php echo $check_res['inp89'];?>">
            </td>
                         <td>
              <input type="text" name="inp90" value="<?php echo $check_res['inp90'];?>">
            </td>
          </tr>

          <tr>
            <td style="width:20%;">
              Ducolax 10mg PO BID x 3days,PRN<br>
Constipation if MOM doesn't Work.
              
            </td>
             <td>
              
              <input type="text" name="inp91" value="<?php echo $check_res['inp91'];?>">
            </td>   
            <td>
                      
              <input type="text" name="inp92" value="<?php echo $check_res['inp92'];?>">
            </td>          
              <td>
             <input type="text" name="inp93" value="<?php echo $check_res['inp93'];?>">
            </td>         
               <td>
               <input type="text" name="inp94" value="<?php echo $check_res['inp94'];?>" >
            </td>           
             <td>
              <input type="text" name="inp95" value="<?php echo $check_res['inp95'];?>">
             
            </td>           
             <td>
               <input type="text" name="inp96" value="<?php echo $check_res['inp96'];?>">
            </td>            
            <td>
              <input type="text" name="inp97" value="<?php echo $check_res['inp97'];?>">
            </td>            
            <td>
             <input type="text" name="inp98" value="<?php echo $check_res['inp98'];?>">
            </td>           
             <td>
              <input type="text" name="inp99" value="<?php echo $check_res['inp90'];?>">
            </td>
                         <td>
              <input type="text" name="inp100" value="<?php echo $check_res['inp100'];?>"> 
            </td>
          </tr>

          <tr>
            <td style="width:20%;">
              Zofran ODT 8mg PO Q 8 hours, Max 2 doses<br>
in 24hrs for refractory to Tigan.
              
            </td>
             <td>
              
              <input type="text" name="inp101" value="<?php echo $check_res['inp101'];?>">
            </td>   
            <td>
                      
              <input type="text" name="inp102" value="<?php echo $check_res['inp102'];?>">
            </td>          
              <td>
             <input type="text" name="inp103" value="<?php echo $check_res['inp103'];?>">
            </td>         
               <td>
               <input type="text" name="inp104" value="<?php echo $check_res['inp104'];?>">
            </td>           
             <td>
              <input type="text" name="inp105" value="<?php echo $check_res['inp105'];?>">
              
             
            </td>           
             <td>
               <input type="text" name="inp106" value="<?php echo $check_res['inp106'];?>">
            </td>            
            <td>
              <input type="text" name="inp107" value="<?php echo $check_res['inp107'];?>">
            </td>            
            <td>
             <input type="text" name="inp108" value="<?php echo $check_res['inp108'];?>">
            </td>           
             <td>
              <input type="text" name="inp109" value="<?php echo $check_res['inp109'];?>">
            </td>
                         <td>
              <input type="text" name="inp110" value="<?php echo $check_res['inp110'];?>">
            </td>
          </tr>

          <tr>
            <td style="width:20%;">
              Promethazine 12.5mg PO Q4 PRN for nausea<br>
and vomiting max dose 3 in 24 hours.
              
            </td>
             <td>
              <input type="text" name="inp111" value="<?php echo $check_res['inp111'];?>">
              
            </td>   
            <td>
                      
              <input type="text" name="inp112" value="<?php echo $check_res['inp112'];?>">
            </td>          
              <td>
             <input type="text" name="inp113" value="<?php echo $check_res['inp113'];?>">
            </td>         
               <td>
               <input type="text" name="inp114" value="<?php echo $check_res['inp114'];?>">
            </td>           
             <td>
              <input type="text" name="inp115" value="<?php echo $check_res['inp115'];?>">
              
             
            </td>           
             <td>
               <input type="text" name="inp116" value="<?php echo $check_res['inp116'];?>">
            </td>            
            <td>
              <input type="text" name="inp117" value="<?php echo $check_res['inp117'];?>">
            </td>            
            <td>
             <input type="text" name="inp118" value="<?php echo $check_res['inp118'];?>">
            </td>           
             <td>
              <input type="text" name="inp119" value="<?php echo $check_res['inp119'];?>">
            </td>
                         <td>
              <input type="text" name="inp120" value="<?php echo $check_res['inp120'];?>">
            </td>
          </tr>
          <tr>
            <td style="width:20%;">
Promethazine HCL 25mg IM Q 6 PRN for<br>
nausea/vomiting. max 4 doses per 24 hours
              
            </td>
             <td>
              <input type="text" name="inp121" value="<?php echo $check_res['inp121'];?>">
              
            </td>   
            <td>
                <input type="text" name="inp122" value="<?php echo $check_res['inp122'];?>">      
              
            </td>          
              <td>
             <input type="text" name="inp123" value="<?php echo $check_res['inp123'];?>">
            </td>         
               <td>
               <input type="text" name="inp124" value="<?php echo $check_res['inp124'];?>">
            </td>           
             <td>
              
              <input type="text" name="inp125" value="<?php echo $check_res['inp125'];?>">
             
            </td>           
             <td>
               <input type="text" name="inp126" value="<?php echo $check_res['inp126'];?>">
            </td>            
            <td>
              <input type="text" name="inp127" value="<?php echo $check_res['inp127'];?>">
            </td>            
            <td>
             <input type="text" name="inp128" value="<?php echo $check_res['inp128'];?>">
            </td>           
             <td>
              <input type="text" name="inp129" value="<?php echo $check_res['inp129'];?>">
            </td>
                         <td>
              <input type="text" name="inp130" value="<?php echo $check_res['inp130'];?>"> 
            </td>
          </tr>
          <tr>
            <td style="width:20%;">
              Bentyl/Dicyclomine hydrochloride 10mg po<br>
q4pm max 4/24 hr abdominal cramps.
              
            </td>
             <td>
              <input type="text" name="inp131" value="<?php echo $check_res['inp131'];?>">
              
            </td>   
            <td>
                   <input type="text" name="inp132" value="<?php echo $check_res['inp132'];?>">   
              
            </td>          
              <td>
             <input type="text" name="inp133" value="<?php echo $check_res['inp133'];?>">
            </td>         
               <td>
               <input type="text" name="inp134" value="<?php echo $check_res['inp134'];?>">
            </td>           
             <td>
              
             <input type="text" name="inp135" value="<?php echo $check_res['inp135'];?>">
             
            </td>           
             <td>
               <input type="text" name="inp136" value="<?php echo $check_res['inp136'];?>">
            </td>            
            <td>
              <input type="text" name="inp137" value="<?php echo $check_res['inp137'];?>">
            </td>            
            <td>
             <input type="text" name="inp138" value="<?php echo $check_res['inp138'];?>">
            </td>           
             <td>
              <input type="text" name="inp139" value="<?php echo $check_res['inp139'];?>">
            </td>
                         <td>
              <input type="text" name="inp140" value="<?php echo $check_res['inp140'];?>">
            </td>
          </tr>
        </table><br><br>

        <div class="parent">
          <div class="sub1">
            <ul>
              <li>Order Date:<input type="date" name="inp141" style="width:36%;" value="<?php echo $check_res['inp141'];?>"></li>
              <li>Nursing Transcribing Orders:<input type="text" name="inp142" value="<?php echo $check_res['inp142'];?>"></li>
              <li>Verifying Nurse:<input type="text" name="inp143" value="<?php echo $check_res['inp143'];?>"></li>
            </ul>
          </div>
           <div class="sub2">
            <ul>
              <li>
                Patient Signature:
                <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                <input type="hidden" name="inp144" id="inp144" style="width:60%;" value="<?php echo text($check_res['inp144']);?>"/>
                <img src='' class="img" id="img_inp144" style="display:none;width:50%;height:100px;" >
                 
                Patient Initials:<input type="text" name="inp145" value="<?php echo $check_res['inp145'];?>">
              </li>
            </ul>
            <br>
                        <ul>
              <li>
                Nurse Signature :
                <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                <input type="hidden" name="inp146" id="inp146" style="width:60%;" value="<?php echo text($check_res['inp146']);?>"/>
                <img src='' class="img" id="img_inp146" style="display:none;width:50%;height:100px;" >
                 
                Nurse Initials:<input type="text" name="inp147" value="<?php echo $check_res['inp147'];?>">
              </li>
                            <li>
                Nurse Signature 
                <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                <input type="hidden" name="inp148" id="inp148" style="width:60%;" value="<?php echo text($check_res['inp148']);?>"/>
                <img src='' class="img" id="img_inp148" style="display:none;width:50%;height:100px;" >
                
                Nurse Initials:<input type="text" name="inp149" value="<?php echo $check_res['inp149'];?>">
              </li>
                            <li>
                Nurse Signature 
                <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                <input type="hidden" name="inp150" id="inp150" style="width:60%;" value="<?php echo text($check_res['inp150']);?>"/>
                <img src='' class="img" id="img_inp150" style="display:none;width:50%;height:100px;" >
                 
                Nurse Initials:<input type="text" name="inp151" value="<?php echo $check_res['inp151'];?>">
              </li>
                            <li>
                Nurse Signature 
                <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                <input type="hidden" name="inp152" id="inp152" style="width:60%;" value="<?php echo text($check_res['inp152']);?>"/>
                <img src='' class="img" id="img_inp152" style="display:none;width:50%;height:100px;" >
                 
                Nurse Initials:<input type="text" name="inp153" value="<?php echo $check_res['inp153'];?>">
              </li>
            </ul>
             
           </div>
            <div class="sub3">
             <b>Reason Medication Not given</b> 
             <ul>
               <li>1.Patient Refused</li>
               <li>2.Patient's Condition</li>
               <li>3.Hold per MD's Order</li>
             </ul>
            </div>
          
        </div>

        <div class="btndiv">
                     <button type="submit" name="sub" value="Submit" class="subbtn">Submit</button>
                     <button class="cancel" type="button" onclick="top.restoreSession(); parent.closeTab(window.name, false);"> <?php echo xlt('Cancel');?> </button>
                  </div>
</form>
</div>
</div>
</div>
  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <div class="col-md-12">
                        <div id="sig">
                            <img id="view_img" style="display:none" width='380px' height='144px'>
                        </div>
                        <br />
                        <br />
                        <br />
                        <button id="clear">Clear</button>
                        <textarea id="sign_data" style="display: none"></textarea>
                    </div>
                    <input type='button' id="add_sign" class="btn btn-success" data-dismiss="modal" value='Add Sign' style='float:right'>

                </div>
            </div>
        </div>
    </div>
    <!-- modal close -->
</body>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="../../forms/admission_orders/assets/js/jquery.signature.min.js"></script>
<script>
    var sig = $('#sig').signature({
        syncField: '#sign_data',
        syncFormat: 'PNG'
    });
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#view_img").attr("src", '');
        $("#view_img").css('display','none');
        $('canvas').css('display','block');
        $("#sign_data").val('');
    });



    var id_name, val, display_edit, icon;


      $('.pen_icon').click(function() {
        id_name = $(this).next('input').attr('id');
        var sign_value = $("#"+id_name).val();
        //alert(sign_value);
        if(sign_value!='')
        {
            // $("#sig").css('display','none');
            $('canvas').css('display','none');
            $("#view_img").css('display','block');
            $("#view_img").attr("src", sign_value);
            $("#sign_data").val(sign_value);

        }
        // else{
        //     $("#)
        // }
    });

    $('#add_sign').click(function() {
        var sign = $('#sign_data').val();
        $('#' + id_name).val(sign);
        if(sign!='')
        {
            $("#img_"+id_name).attr('src',sign);
            $("#img_"+id_name).css('display','block');
        }
        else{
            $("#img_"+id_name).css('display','none');
        }

        $('#sign_data').val('');
        sig.signature('clear');
       // $("#sign_data").val('');
       // check_sign();
    });

    $('.radio_change').on('change',function(){
        var checkbox_class= $(this).attr('data-id');
        if($(this).is(":checked"))
        {
            $('.'+checkbox_class).prop('checked',false);
            $(this).prop('checked',true);
            // $('#'+checkbox_class).val($(this).val());
        }
    })

    $(document).ready(function() {

        check_sign();

    })

    function check_sign() {

        $(".pen_icon").each(function() {

            var id_name1 = $(this).next('input').attr('id');
            var sign_value = $("#"+id_name1).val();

            if(sign_value!='')
            {
                $("#img_"+id_name1).css('display','block');
                $("#img_"+id_name1).attr('src',sign_value);

            }

        });

    }
</script>
</html>