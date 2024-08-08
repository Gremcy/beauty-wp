<?php

namespace PS\XmlExport\Interfaces;

interface IParser {
    public function parseData(string $filePath) : array;
}