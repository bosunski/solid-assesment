<?php

namespace language;

use Language\LanguageBatch;

chdir(__DIR__);

include('../vendor/autoload.php');

LanguageBatch::generateLanguageFiles();
LanguageBatch::generateAppletLanguageXmlFiles();


