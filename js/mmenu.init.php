<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $mmenu_options_lite; 

$theme = $mmenu_options_lite ['theme'];
$position = $mmenu_options_lite ['position'];
$zposition = $mmenu_options_lite ['zposition'];
$header = $mmenu_options_lite ['header'];
$headertitle = $mmenu_options_lite ['headertitle'];
$counters = $mmenu_options_lite ['counters'];
$slidingsubmenus = $mmenu_options_lite ['slidingsubmenus'];
$searchfield = $mmenu_options_lite ['searchfield'];


// Logic

if ($header == "1") { $header = "true"; }
else { $header = "false"; }

if ($counters == "1") { $counters = "true"; }
else { $counters = "false"; }

if ($slidingsubmenus == "1") { $slidingsubmenus = "true"; }
else { $slidingsubmenus = "false"; }

if ($searchfield == "1") { $searchfield = "true"; }
else { $searchfield = "false"; }

?>
<script type="text/javascript">
	jQuery(function() {
		jQuery("#mmenu").mmenu({classes: "<?php echo $theme; ?>", position: "<?php echo $position; ?>", zposition: "<?php echo $zposition; ?>", header: {add: <?php echo $header; ?>, title: "<?php echo $headertitle; ?>", update: "true"}, counters: <?php echo $counters; ?>, slidingSubmenus: <?php echo $slidingsubmenus; ?>, searchfield: <?php echo $searchfield; ?>});
	});
</script>