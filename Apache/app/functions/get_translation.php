<?php
function get_translation($text)
{
    global $language;
    $translation=$language[$text];
    if (!isset($translation)) $translation="Untranslated";
    return $translation;
}
?>