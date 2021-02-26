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
 * A two column layout for the learnbook theme.
 *
 * @package   theme_learnbook
 * @copyright 2016 Damyon Wiese
 * @author    2020 safat shahin <safat@ecreators.com.au>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

user_preference_allow_ajax_update('drawer-open-nav', PARAM_ALPHA);
require_once($CFG->libdir . '/behat/lib.php');
$PAGE->requires->js_call_amd('theme_learnbook/learnbook', 'init');
if (isloggedin()) {
    $navdraweropen = (get_user_preferences('drawer-open-nav', 'true') == 'true');
} else {
    $navdraweropen = false;
}
//$navdraweropen = false;
$extraclasses = [];
if ($navdraweropen) {
    $extraclasses[] = 'drawer-open-left';
}
$bodyattributes = $OUTPUT->body_attributes($extraclasses);
$blockshtml = $OUTPUT->blocks('side-pre');
$hasblocks = strpos($blockshtml, 'data-block=') !== false;
$regionmainsettingsmenu = $OUTPUT->region_main_settings_menu();
//footer
$layoutSettings = get_config('theme_learnbook');
$layoutSettings->row1_isDisabled = ($layoutSettings->footerlayoutrow1 == '0-0-0-0') ? true : false;
$layoutSettings->row1_is1        = ($layoutSettings->footerlayoutrow1 == '12-0-0-0') ? true : false;
$layoutSettings->row1_is66       = ($layoutSettings->footerlayoutrow1 == '6-6-0-0') ? true : false;
$layoutSettings->row1_is444      = ($layoutSettings->footerlayoutrow1 == '4-4-4-0') ? true : false;
$layoutSettings->row1_is3333     = ($layoutSettings->footerlayoutrow1 == '3-3-3-3') ? true : false;
$layoutSettings->row1_is633      = ($layoutSettings->footerlayoutrow1 == '6-3-3-0') ? true : false;
$layoutSettings->row1_is336      = ($layoutSettings->footerlayoutrow1 == '3-3-6-0') ? true : false;
$layoutSettings->row1_is363      = ($layoutSettings->footerlayoutrow1 == '3-6-3-0') ? true : false;
$layoutSettings->row1_is48       = ($layoutSettings->footerlayoutrow1 == '4-8-0-0') ? true : false;
$layoutSettings->row1_is84       = ($layoutSettings->footerlayoutrow1 == '8-4-0-0') ? true : false;
$layoutSettings->row1_is39       = ($layoutSettings->footerlayoutrow1 == '3-9-0-0') ? true : false;
$layoutSettings->row1_is93       = ($layoutSettings->footerlayoutrow1 == '9-3-0-0') ? true : false;
$layoutSettings->row1_is57       = ($layoutSettings->footerlayoutrow1 == '5-7-0-0') ? true : false;
$layoutSettings->row1_is75       = ($layoutSettings->footerlayoutrow1 == '7-5-0-0') ? true : false;

$templatecontext = [
    'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
    'output' => $OUTPUT,
    'sidepreblocks' => $blockshtml,
    'hasblocks' => $hasblocks,
    'bodyattributes' => $bodyattributes,
    'navdraweropen' => $navdraweropen,
    'regionmainsettingsmenu' => $regionmainsettingsmenu,
    'hasregionmainsettingsmenu' => !empty($regionmainsettingsmenu),
    'layoutSettings' => $layoutSettings
];

$nav = $PAGE->flatnav;
$templatecontext['flatnavigation'] = $nav;
$templatecontext['firstcollectionlabel'] = $nav->get_collectionlabel();
echo $OUTPUT->render_from_template('theme_learnbook/columns2', $templatecontext);

