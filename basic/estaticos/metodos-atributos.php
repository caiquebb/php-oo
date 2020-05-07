<?php

class Html
{
    public static $mainTag = '<html>';
    const END_TAG = '</html>';

    public static function openTagHtml()
    {
        return self::$mainTag;
    }

    public function endTagHtml()
    {
        return self::END_TAG;
    }
}

// $html = new Html;

// print $html->openTagHtml();

print Html::openTagHtml();
print Html::endTagHtml();
print "\n";

print Html::$mainTag;
print Html::END_TAG;
print "\n";
