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
 * Theme Learnbook - upgrade file
 *
 * @package    theme_learnbook
 * @copyright  2019 eCreators PTY LTD
 * @author     2019 Chris Megahan, eCreators <chris@ecreators.com.au>
 * @author     2021 Fouad Saikali, eCreators <fouad.saikali@ecreators.com.au>
 * @author     2021 Lupiya Mujala, eCreators <lupiya.mujala@ecreators.com.au>
 * @author     2021 Rob Hunt, eCreators <rob.hunt@ecreators.com.au>
 * @author     2021 Safat Shahin, eCreators <safat.shahin@ecreators.com.au>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Function to upgrade theme_learnbook
 * @param int $oldversion the version we are upgrading from
 * @return bool result
 */
function xmldb_theme_learnbook_upgrade($oldversion) {
    global $DB;
    // this is the first version, so no upgrade steps are required
    return true;
}
