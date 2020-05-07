<?php

namespace Pigvelop\Export;

use Pigvelop\Export\Contract\Export;

class JsonExport implements Export
{
    public function doExport()
    {
        return 'JSON exported!';
    }
}
