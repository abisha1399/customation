<?php

/* Copyright (C) 2005-2007 Rod Roark <rod@sunsetsystems.com>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 */

/*
 *
 * This popup is called when adding/editing a calendar event
 *
 */

require_once('../../globals.php');
require_once("$srcdir/patient.inc");

use OpenEMR\Common\Acl\AclMain;
use OpenEMR\Core\Header;

$info_msg = "";

 // If we are searching, search.
 // first set $result to empty
$result = "";
if (!empty($_REQUEST['searchparm'])) {
     $searchparm = trim($_REQUEST['searchparm']);
$sql = sqlStatement("select * from users where username like '%$searchparm%' and authorized = 1 ");
    for ($iter = 0; $row = sqlFetchArray($sql); $iter++) {
        $returnval[$iter] = $row;
    }
}
    $result = $returnval;
?>
<!DOCTYPE html>
<html>
<head>
    <?php Header::setupHeader(['common', 'datetime-picker', 'opener']); ?>
<title><?php echo htmlspecialchars(xl('Provider Finder'), ENT_NOQUOTES); ?></title>

<style>
form {
    padding: 0;
    margin: 0;
}
#searchCriteria {
    text-align: center;
    width: 100%;
    font-weight: bold;
    padding: 3px;
}
#searchResultsHeader {
    width: 100%;
    border-collapse: collapse;
}
#searchResults {
    width: 100%;
    border-collapse: collapse;
    background-color: var(--white);
    overflow: auto;
}

#searchResults tr {
    cursor: hand;
    cursor: pointer;
}
#searchResults td {
    /*font-size: 0.7em;*/
    border-bottom: 1px solid var(--light);
}
.billing {
    color: var(--danger);
    font-weight: bold;
}

/* for search results or 'searching' notification */
#searchstatus {
    font-weight: bold;
    font-style: italic;
    color: var(--black);
    text-align: center;
}
#searchspinner {
    display: inline;
    visibility: hidden;
}

/* highlight for the mouse-over */
.highlight {
    background-color: #336699;
    color: var(--white);
}
</style>

<!-- ViSolve: Verify the noresult parameter -->
<?php
if (isset($_GET["res"])) {
    echo '
<script>
    // Pass the variable to parent hidden type and submit
    opener.document.theform.resname.value = "noresult";
    opener.document.theform.submit();
    // Close the window
    window.self.close();
</script>';
}
?>
<!-- ViSolve: Verify the noresult parameter -->

</head>

<body class="body_top">
<div class="container-responsive">
<div id="searchCriteria" class="bg-light p-2 pt-3">
<form method='post' name='theform' id="theform" action='provider_find.php?<?php if (isset($_GET['pflag'])) {
    echo "pflag=0"; } ?>'>
    <div class="form-row">
    
    <label for="searchparm" class="col-form-label col-form-label-sm col"><?php echo htmlspecialchars(xl('Username'), ENT_NOQUOTES); ?></label>
   <input type='text' class="form-control form-control-sm col" id='searchparm' name='searchparm' size='12' value='<?php echo attr($_REQUEST['searchparm'] ?? ''); ?>' title='<?php echo htmlspecialchars(xl('If name, any part of lastname or lastname,firstname'), ENT_QUOTES); ?>' />
    <div class="col">
    <input class='btn btn-primary btn-sm' type='submit' id="submitbtn" value='<?php echo htmlspecialchars(xl('Search'), ENT_QUOTES); ?>' />
        <div id="searchspinner"><img src="<?php echo $GLOBALS['webroot'] ?>/interface/pic/ajax-loader.gif" /></div>
    </div>
    </div>
</form>
</div>

<?php if (! isset($_REQUEST['searchparm'])) : ?>
<div id="searchstatus"><?php echo htmlspecialchars(xl('Enter your search criteria above'), ENT_NOQUOTES); ?></div>
<?php elseif (! is_countable($result)) : ?>
<div id="searchstatus" class="alert alert-danger rounded-0"><?php echo htmlspecialchars(xl('No records found. Please expand your search criteria.'), ENT_NOQUOTES); ?>
<br />
<!--VicarePlus :: If pflag is set the new patient create link will not be displayed -->
<a class="noresult" href='provider_find.php?res=noresult'
    <?php
    if (isset($_GET['pflag']) || (!AclMain::aclCheckCore('patients', 'demo', '', array('write','addonly')))) {
        ?> style="display: none;"
        <?php
    }
    ?>  >
    <?php echo htmlspecialchars(xl('Click Here to add a new patient.'), ENT_NOQUOTES); ?></a>
</div>
<?php elseif (count($result) >= 100) : ?>
<div id="searchstatus" class="alert alert-danger rounded-0"><?php echo htmlspecialchars(xl('More than 100 records found. Please narrow your search criteria.'), ENT_NOQUOTES); ?></div>
<?php elseif (count($result) < 100) : ?>
<div id="searchstatus" class="alert alert-success rounded-0"><?php echo htmlspecialchars(count($result), ENT_NOQUOTES); ?> <?php echo htmlspecialchars(xl('records found.'), ENT_NOQUOTES); ?></div>
<?php endif; ?>

<?php if (isset($result)) : ?>
<table class="table table-sm">
<thead id="searchResultsHeader" class="head">
 <tr>
  <th class="srName"><?php echo htmlspecialchars(xl('Username'), ENT_NOQUOTES); ?></th>
  <th class="srPhone"><?php echo htmlspecialchars(xl('ID'), ENT_NOQUOTES); ?></th>
  <th class="srSS"><?php echo htmlspecialchars(xl('Firstname'), ENT_NOQUOTES); ?></th>
  <th class="srfname"><?php echo htmlspecialchars(xl('Lastname'), ENT_NOQUOTES); ?></th>
  <th class="srlname"><?php echo htmlspecialchars(xl('Providertype'), ENT_NOQUOTES); ?></th>
 </tr>
</thead>
<tbody id="searchResults">
    <?php
    if (is_countable($result)) {
        foreach ($result as $iter) {
            $username   = $iter['username'];
            $id   = $iter['id'];
            $fname   = $iter['fname'];
            $lname   = $iter['lname'];
            $provider=$iter['provider']!=''?'Assistant Provider':'Provider';

            // if($iter["provider"]!=''){
            //     echo "Assistant Provider";
            // }
            // else{
            //     echo "Provider";
            // }

            // If billing note exists, then it gets special coloring and an extra line of output
            // in the 'name' column.
            $trClass = "oneresult";
            if (!empty($iter['billing_note'])) {
                $trClass .= " billing";
            }

            echo " <tr class='" . $trClass . "' id='" .
            htmlspecialchars($username."~".$id, ENT_QUOTES) . "'>";
            echo "  <td class='srName'>" . htmlspecialchars($username, ENT_NOQUOTES);
            echo "</td>\n";
            echo "  <td class='srPhone'>" . htmlspecialchars($id, ENT_NOQUOTES) . "</td>\n"; //(CHEMED) Search by phone number
            echo "  <td class='srSS'>" . htmlspecialchars($fname, ENT_NOQUOTES) . "</td>\n";
            echo "  <td class='srDOB'>" . htmlspecialchars($lname, ENT_NOQUOTES) . "</td>\n";
            echo "  <td class='srDOB'>" . htmlspecialchars($provider, ENT_NOQUOTES) . "</td>\n";
            echo " </tr>";
        }
    }
    ?>
</tbody>
</table>

<?php endif; ?>

<script>

// jQuery stuff to make the page a little easier to use

$(function () {
    $("#searchparm").focus();
    $(".oneresult").mouseover(function() { $(this).toggleClass("highlight"); });
    $(".oneresult").mouseout(function() { $(this).toggleClass("highlight"); });
    $(".oneresult").click(function() { SelectPatient(this); });
    //ViSolve
    $(".noresult").click(function () { SubmitForm(this);});
    $("#theform").submit(function() { SubmitForm(this); });

});



// show the 'searching...' status and submit the form
var SubmitForm = function(eObj) {
    $("#submitbtn").css("disabled", "true");
    $("#searchspinner").css("visibility", "visible");
    return true;
}


// another way to select a patient from the list of results
// parts[] ==>  0=PID, 1=LName, 2=FName, 3=DOB
var SelectPatient = function (eObj) {
    objID = eObj.id;
    var parts = objID.split("~");
            opener.setprovider(parts[0],parts[1]);
        dlgclose();
        return false;
}

</script>

</div>
</body>
</html>