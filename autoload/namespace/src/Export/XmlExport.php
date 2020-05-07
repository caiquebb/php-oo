<?php

namespace Pigvelop\Export;

use Pigvelop\Export\Contract\Export;

class XmlExport implements Export
{
    public function doExport()
    {
        return 'XML exported!';
    }
}
