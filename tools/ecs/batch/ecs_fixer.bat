:: Run easy-coding-standard (ecs) via this batch file inside your IDE e.g. PhpStorm (Windows only)
:: Install inside PhpStorm the  "Batch Script Support" plugin
cd..
cd..
cd..
cd..
cd..
cd..
php vendor\bin\ecs check vendor/jedocodes/contao-css-marquee-bundle/src --fix --config vendor/jedocodes/contao-css-marquee-bundle/tools/ecs/config.php
php vendor\bin\ecs check vendor/jedocodes/contao-css-marquee-bundle/contao --fix --config vendor/jedocodes/contao-css-marquee-bundle/tools/ecs/config.php
php vendor\bin\ecs check vendor/jedocodes/contao-css-marquee-bundle/config --fix --config vendor/jedocodes/contao-css-marquee-bundle/tools/ecs/config.php
php vendor\bin\ecs check vendor/jedocodes/contao-css-marquee-bundle/templates --fix --config vendor/jedocodes/contao-css-marquee-bundle/tools/ecs/config.php
php vendor\bin\ecs check vendor/jedocodes/contao-css-marquee-bundle/tests --fix --config vendor/jedocodes/contao-css-marquee-bundle/tools/ecs/config.php
