<?php

chdir(__DIR__);

include('../vendor/autoload.php');

$languageBatchBo = new \Language\LanguageBatch();
$languageBatchBo->generateLanguageFiles();
$languageBatchBo->generateAppletLanguageXmlFiles();
