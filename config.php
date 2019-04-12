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
 * Theme Learnbook - config file
 *
 * @package    theme_learnbook
 * @author     2019 Chris Megahan, eCreators <chris@ecreators.com.au>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/lib.php');

$THEME->name = 'learnbook';
$THEME->parents = ['boost'];
$THEME->editor_sheets = [];
$THEME->scss = function($theme) {
    return theme_learnbook_get_main_scss_content($theme);
};

$THEME->layouts = [
    'login' => array(
        'file' => 'login.php',
        'regions' => array(),
        'options' => array('langmenu' => true),
    ),
    'myteam' => array(
        'file' => 'myteam.php',
        'regions' => array('center'),
        'defaultregion' => 'center',
    ),
    'admindashboard' => array(
        'file' => 'admindashboard.php',
        'regions' => array('top-left', 'top-center','top-right','bottom'),
        'defaultregion' => 'bottom',
    )
];

$THEME->enable_dock = false;
$THEME->yuicssmodules = array();
$THEME->rendererfactory = 'theme_overridden_renderer_factory';
$THEME->prescsscallback = 'theme_learnbook_get_pre_scss';
$THEME->requiredblocks = '';
$THEME->hidefromselector = false;
