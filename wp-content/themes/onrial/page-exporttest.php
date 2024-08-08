<?php

use PS\XmlExport\Exporter;
use PS\XmlExport\ShortExporter;
use PS\XmlExport\XmlParser;

$logger = wc_get_logger();

$path = ABSPATH . '/wp-content/1C_WPExpSours.xml'; //full
//$path = ABSPATH . '/wp-content/1C_WPExpSoursRest.xml'; //short

$parser = new XmlParser($path);

//$exporter = new ShortExporter($parser, $logger);
$exporter = new Exporter($parser, $logger);

$exporter->refreshStock();

echo "Success!";

exit;