<?php
require_once __DIR__ . '/icons_data.php';

/**
 * Render an inline Lucide SVG icon.
 * @param string $name   kebab-case icon name (see icons_data.php)
 * @param int    $size   width/height in px
 * @param string $class  extra CSS classes
 * @param array  $attrs  extra attributes e.g. ['stroke-width' => '2.5','aria-hidden'=>'true']
 */
function icon($name, $size = 24, $class = '', $attrs = []) {
    $map = $GLOBALS['LUCIDE_ICONS'] ?? [];
    $inner = $map[$name] ?? '';
    $sw = $attrs['stroke-width'] ?? '2';
    unset($attrs['stroke-width']);
    $extra = '';
    foreach ($attrs as $k => $v) {
        $extra .= ' ' . $k . '="' . e($v) . '"';
    }
    $cls = trim('lucide ' . $class);
    return '<svg xmlns="http://www.w3.org/2000/svg" width="' . (int)$size . '" height="' . (int)$size
        . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="' . e($sw)
        . '" stroke-linecap="round" stroke-linejoin="round" class="' . e($cls) . '"' . $extra . '>'
        . $inner . '</svg>';
}
