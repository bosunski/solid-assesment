<?php

namespace language;

use Language\LanguageFiles;
use Language\AppletLanguages;
use Language\Results;
use Language\LanguageCache;
use Language\LanguageResponse;

chdir(__DIR__);

include('../vendor/autoload.php');

$languageBatchBo = new \Language\LanguageBatch(new LanguageFiles(new Results, new LanguageCache, new LanguageResponse), 
                                                new AppletLanguages(new Results), new Results, new LanguageCache
                                                );
$languageBatchBo->generateLanguageFiles();
$languageBatchBo->generateAppletLanguageXmlFiles();


