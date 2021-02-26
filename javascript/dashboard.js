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
 * theme_learnbook
 *
 * @package    theme
 * @subpackage learnbook
 * @copyright  2020 eCreators PTY LTD
 * @author     2020 Safat Shahin, eCreators <safat.shahin@ecreators.com.au>
 */

$( document ).ready(function() {
    // CSS hack for the LB Courses block to prevent squishing when timeline is clicked.
    var calIcon = $('.block_lb_courses .cal-icon');
    calIcon.click(function() {
        var courseList = $('.lb_courses_list .coursebox.grid');
        if ($(this).hasClass('icon-selected')) {
            courseList.removeClass('col-xl-4').addClass('col-xl-3');
        } else {
            courseList.removeClass('col-xl-3').addClass('col-xl-4');
        }
    });
});
