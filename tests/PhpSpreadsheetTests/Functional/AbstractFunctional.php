<?php

namespace PhpOffice\PhpSpreadsheetTests\Functional;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\File;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PHPUnit\Framework\TestCase;

/**
 * Base class for functional test to write and reload file on disk across different formats.
 */
abstract class AbstractFunctional extends TestCase
{
    /**
     * Write spreadsheet to disk, reload and return it.
     *
     * @param Spreadsheet $spreadsheet
     * @param string $format
     *
     * @return Spreadsheet
     */
    protected function writeAndReload(Spreadsheet $spreadsheet, $format)
    {
        $filename = tempnam(File::sysGetTempDir(), 'phpspreadsheet-test');
        $writer = IOFactory::createWriter($spreadsheet, $format);
        $writer->save($filename);

        $reader = IOFactory::createReader($format);
        $reloadedSpreadsheet = $reader->load($filename);
        unlink($filename);

        return $reloadedSpreadsheet;
    }
}
