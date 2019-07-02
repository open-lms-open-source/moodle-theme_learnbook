<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Theme Learnbook - login layout file
 *
 * @package    theme_learnbook
 * @author     2019 Chris Megahan, eCreators <chris@ecreators.com.au>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$bodyattributes = $OUTPUT->body_attributes();

$context = context_system::instance();

$fs = get_file_storage();
$files = $fs->get_area_files($context->id, 'theme_learnbook', 'slideshow', 0);

$slideshowImgs = array();
foreach ($files as $file) {
    $filename = $file->get_filename();
    if($filename != ".")
    {        
        $url = moodle_url::make_pluginfile_url($file->get_contextid(), $file->get_component(), $file->get_filearea(), $file->get_itemid(), $file->get_filepath(), $file->get_filename());        
        $slideshowImgs[] = preg_replace('|^https?://|i', '//', $url->out(false));
    }
}

$welcomeImg = null;
$welcomeImgFiles = $fs->get_area_files($context->id, 'theme_learnbook', 'welcomeimg', 0);
foreach ($welcomeImgFiles as $file) {
    $filename = $file->get_filename();
    $filetype = $file->get_mimetype();
    if ($filetype && $filename != '.') {
        $url = moodle_url::make_pluginfile_url($context->id, 'theme_learnbook', 'welcomeimg', 0, '/', $filename);
        $welcomeImg = $url->out();
    }
}

$templatecontext = [
    'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
    'output' => $OUTPUT,
    'bodyattributes' => $bodyattributes,
    'slideshowImgs' => !empty($slideshowImgs) ? json_encode($slideshowImgs) : null,
    'welcomeimg' => $welcomeImg
];

echo $OUTPUT->render_from_template('theme_learnbook/login', $templatecontext);