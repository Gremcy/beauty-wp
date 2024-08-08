<?php

class Logger
{
    public function writeToLog($data, $title = ''): bool
    {
        $log = "\n------------------------\n";
        $log .= current_time("Y.m.d H:i:s") . "\n";
        $log .= (strlen($title) > 0 ? $title : 'DEBUG') . "\n";
        $log .= print_r($data, 1);
        $log .= "\n------------------------\n";
        file_put_contents(ABSPATH . 'log/' . date('Y-m-d') . '-lead.log', $log, FILE_APPEND);
        return true;
    }
}