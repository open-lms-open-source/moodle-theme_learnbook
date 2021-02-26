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
 * @author     2020 Fouad Saikali, eCreators <fouad.saikali@ecreators.com.au>
 * @author     2020 Lupiya Mujala, eCreators <lupiya.mujala@ecreators.com.au>
 * @author     2020 Rob Hunt, eCreators <rob.hunt@ecreators.com.au>
 * @author     2020 Safat Shahin, eCreators <safat.shahin@ecreators.com.au>
 */

$( document ).ready(function() {

    //set title/tooltip for all menu items
    $(".list-group-item-action").each(function(i, v) {
        var iconEl = $(this).children().find('.menu-title');
        if(iconEl.length >= 1)
        {
            var title = iconEl.attr('title');
            if(title)
                $(this).attr('title', title);
        }
    });

    $('button[aria-controls="nav-drawer"]').attr('title','Menu');

});
