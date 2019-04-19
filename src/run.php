<?php

chdir(__DIR__);

include('../vendor/autoload.php');

use Language\LanguageBatch;
use Language\Applet;


LanguageBatch::generateLanguageFiles();
Applet::generateAppletLanguageXmlFiles();