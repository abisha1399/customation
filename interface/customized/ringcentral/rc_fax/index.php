<?php
/**
 *	oeMessage
 *  Fax UI (REST interface Fax/SMS)
 *	Copyright (c)2018 - Jerry Padgett. Padgett's Consulting
 *
 *	This program is licensed software: licensee is granted a limited nonexclusive
 *  license to install this Software on more than one computer system, as long as all
 *  systems are used to support a single licensee. Licensor is and remains the owner
 *  of all titles, rights, and interests in program.
 *
 *  Licensee will not make copies of this Software or allow copies of this Software
 *  to be made by others, unless authorized by the licensor. Licensee may make copies
 *  of the Software for backup purposes only.
 *
 *	This program is distributed in the hope that it will be useful, but WITHOUT
 *	ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 *  FOR A PARTICULAR PURPOSE. LICENSOR IS NOT LIABLE TO LICENSEE FOR ANY DAMAGES,
 *  INCLUDING COMPENSATORY, SPECIAL, INCIDENTAL, EXEMPLARY, PUNITIVE, OR CONSEQUENTIAL
 *  DAMAGES, CONNECTED WITH OR RESULTING FROM THIS LICENSE AGREEMENT OR LICENSEE'S
 *  USE OF THIS SOFTWARE.
 *
 *  @package oeMessage
 *  @version 1.0
 *  @copyright Jerry Padgett
 *  @author Jerry Padgett <sjpadgett@gmail.com>
 *  @uses Fax and Patient SMS Notifications
 *
 **/

require_once("../../../globals.php");
require_once("./libs/controller/ClientAppController.php");

use OpenEMR\Core\Header;

// kick off app endpoints controller
$clientApp = new clientController();

echo "<script>var pid='" . attr($pid) . "'</script>";

?>
