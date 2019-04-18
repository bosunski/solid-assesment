<?php

chdir(__DIR__);

include('../vendor/autoload.php');

use Language\Applet;
use Language\LanguageBatch;

LanguageBatch::generateLanguageFiles();
Applet::generateLanguageXmlFiles();
