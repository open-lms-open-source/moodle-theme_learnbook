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
 * Theme Learnbook - settings file
 *
 * @package    theme_learnbook
 * @author     2020 Safat Shahin, eCreators <safat@ecreators.com.au>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $OUTPUT, $PAGE;
//footer
$bootstrap12 = array(
    '0-0-0-0' => get_string('disabled', 'theme_learnbook'),
    '12-0-0-0' => '1',
    '6-6-0-0' => '6 + 6',
    '4-4-4-0' => '4 + 4 + 4',
    '3-3-3-3' => '3 + 3 + 3 + 3',
    '6-3-3-0' => '6 + 3 + 3',
    '3-3-6-0' => '3 + 3 + 6',
    '3-6-3-0' => '3 + 6 + 3',
    '4-8-0-0' => '4 + 8',
    '8-4-0-0' => '8 + 4',
    '3-9-0-0' => '3 + 9',
    '9-3-0-0' => '9 + 3',
    '5-7-0-0' => '5 + 7',
    '7-5-0-0' => '7 + 5',
);

$bootstrap12defaults = array ('3-3-3-3', '4-4-4-0', '3-3-3-3', '0-0-0-0', '0-0-0-0',
    '0-0-0-0', '0-0-0-0', '0-0-0-0', '0-0-0-0', '0-0-0-0');

$marketingfooterbuilderdefaults = array ('3-3-3-3', '0-0-0-0', '0-0-0-0', '0-0-0-0', '0-0-0-0',
    '0-0-0-0', '0-0-0-0', '0-0-0-0', '0-0-0-0', '0-0-0-0');

$page = new admin_settingpage('theme_learnbook_layout', get_string('layoutsettings', 'theme_learnbook'));

$page->add(new admin_setting_heading('theme_learnbook_footer', get_string('footersettings', 'theme_learnbook'),
    format_text(get_string('footersettingsheading', 'theme_learnbook'), FORMAT_MARKDOWN)));

// Show Footer blocks.
$name = 'theme_learnbook/showfooterblocks';
$title = get_string('showfooterblocks', 'theme_learnbook');
$description = get_string('showfooterblocksdesc', 'theme_learnbook');
$setting = new admin_setting_configcheckbox($name, $title, $description, 0);
$page->add($setting);

// Show moodle login info
$name = 'theme_learnbook/moodlefooterinfo';
$title = get_string('moodlefooterinfo', 'theme_learnbook');
$description = get_string('moodlefooterinfodesc', 'theme_learnbook');
$default = true;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Show moodle docs link.
$name = 'theme_learnbook/moodledocs';
$title = get_string('moodledocs', 'theme_learnbook');
$description = get_string('moodledocsdesc', 'theme_learnbook');
$default = true;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$totalblocks = 0;
$imgpath = $CFG->wwwroot.'/theme/learnbook/pix/layout-builder/';
$imgblder = '';
for ($i = 1; $i <= 1; $i++) {
    $name = 'theme_learnbook/footerlayoutrow' . $i;
    $title = get_string('footerlayoutrow', 'theme_learnbook');
    $description = get_string('footerlayoutrowdesc', 'theme_learnbook');
    $default = $marketingfooterbuilderdefaults[$i - 1];
    $choices = $bootstrap12;
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settingname = 'footerlayoutrow' . $i;

    if (!isset($PAGE->theme->settings->$settingname)) {
        $PAGE->theme->settings->$settingname = '0-0-0-0';
    }

    if ($PAGE->theme->settings->$settingname !== '0-0-0-0') {
        $imgblder .= '<img class="img-responsive" src="'. $imgpath . $PAGE->theme->settings->$settingname . '.png' .'" alt="Footer layout">';
    }

    $vals = explode('-', $PAGE->theme->settings->$settingname);
    foreach ($vals as $val) {
        if ($val > 0) {
            $totalblocks ++;
        }
    }
}

$page->add(new admin_setting_heading('theme_learnbook_footerlayoutcheck', get_string('layoutcheck', 'theme_learnbook'),
    format_text(get_string('layoutcheckdesc', 'theme_learnbook'), FORMAT_MARKDOWN)));

$page->add(new admin_setting_heading('theme_learnbook_footerlayoutbuilder', '', $imgblder));

$page->add(new admin_setting_heading('theme_learnbook_footerlayoutaddcontent', get_string('layoutaddcontent', 'theme_learnbook'),
    get_string('layoutaddcontentdesc', 'theme_learnbook')));

// Footnote.
$name = 'theme_learnbook/footnote';
$title = get_string('footnote', 'theme_learnbook');
$description = get_string('footnotedesc', 'theme_learnbook');
$default = '';
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$page->add($setting);

for ($i = 1; $i <= 4; $i++) {
    $name = 'theme_learnbook/footer' . $i . 'content';
    $title = get_string('footercontent', 'theme_learnbook') . $i;
    $description = get_string('footercontentdesc', 'theme_learnbook') . $i;
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $page->add($setting);
}

$ADMIN->add('theme_learnbook', $page);
