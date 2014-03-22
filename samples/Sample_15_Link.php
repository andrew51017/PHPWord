<?php
/**
 * Link sample
 */

// Init
error_reporting(E_ALL);
define('EOL', (PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once '../src/PhpWord.php';

// New Word document
echo date('H:i:s'), " Create new PhpWord object", EOL;
$phpWord = new PhpOffice\PhpWord\PhpWord();

// Begin code
$section = $phpWord->createSection();

// Add hyperlink elements
$section->addLink('http://www.google.com', 'Best search engine', array('color'=>'0000FF', 'underline' => PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE));
$section->addTextBreak(2);

$phpWord->addLinkStyle('myOwnLinkStyle', array('bold'=>true, 'color'=>'808000'));
$section->addLink('http://www.bing.com', null, 'myOwnLinkStyle');
$section->addLink('http://www.yahoo.com', null, 'myOwnLinkStyle');

// End code

// Save file
$name = basename(__FILE__, '.php');
$writers = array('Word2007' => 'docx', 'ODText' => 'odt', 'RTF' => 'rtf');
foreach ($writers as $writer => $extension) {
    echo date('H:i:s'), " Write to {$writer} format", EOL;
    $xmlWriter = PhpOffice\PhpWord\IOFactory::createWriter($phpWord, $writer);
    $xmlWriter->save("{$name}.{$extension}");
    rename("{$name}.{$extension}", "results/{$name}.{$extension}");
}

// Done
echo date('H:i:s'), " Done writing file(s)", EOL;
echo date('H:i:s'), " Peak memory usage: ", (memory_get_peak_usage(true) / 1024 / 1024), " MB", EOL;
