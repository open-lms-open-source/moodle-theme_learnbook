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
    // Two functions to determine caps lock state.
    // Requires two as for some reason keydown won't detect caps off and keyup won't detect caps on.
    var password = $('#password');
    password.keydown(function (e) {
        if (e.originalEvent.getModifierState("CapsLock")) {
            $('#login-caps-lock-warning-icon').show();
        } else {
            $('#login-caps-lock-warning-icon').hide();
        }
    });

    password.keyup(function (e) {
        if (e.originalEvent.getModifierState("CapsLock")) {
            $('#login-caps-lock-warning-icon').show();
        } else {
            $('#login-caps-lock-warning-icon').hide();
        }
    });

});
