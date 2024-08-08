<?php

namespace PS\Functions\Helper;

use PS\XmlExport\Exporter;
use PS\XmlExport\ShortExporter;
use PS\XmlExport\XmlParser;

/**
 * Class Cron
 * @package PS\Functions\Helper
 */
class Cron {

	/**
	 * constructor
	 */
	public function __construct() {
        // import
        add_action( 'init', array( $this, 'start_cron' ) );
	}

    /**
     * START CRON
     */
    public function start_cron() {
        if ( isset( $_GET['_cron'] ) ) {
            $logger = wc_get_logger();

            if($_GET['_cron'] === 'hour'){


                $parser = new XmlParser(ABSPATH . '/wp-content/1C_WPExpSoursRest.xml'); // short
                
                $exporter = new ShortExporter($parser, $logger);
                
                $exporter->refreshStock();
            }elseif($_GET['_cron'] === 'day'){


                $parser = new XmlParser(ABSPATH . '/wp-content/1C_WPExpSours.xml'); // short
                
                $exporter = new Exporter($parser, $logger);
                
                $exporter->refreshStock();
            }
        }

        return true;
    }

}