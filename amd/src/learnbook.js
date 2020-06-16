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
 * @copyright  2020 eCreators Safat
 */

define(['jquery', 'core/ajax', 'core/str', 'core/config', 'core/templates', 'core/notification'],
    function ($, AJAX, str, mdlcfg, templates, notification) {
        var learnbook = {
            init: function () {
                //for right menu
                // if (localStorage.getItem('rightMenuHidden') === '1') {
                //     $("#region-right-menu").addClass('hide-section');
                //     $("#region-main.has-blocks").css("width", "100%");
                //     $("#right-menu-left-icon").css("display", "block");
                // }
                $('#right-menu-right-icon').click(function () {
                    $("#region-right-menu").addClass('hide-section');
                    $("#region-main.has-blocks").css("width", "100%");
                    $("#right-menu-left-icon").css("display", "block");
                    // localStorage.setItem('rightMenuHidden', '1');
                });
                $('#right-menu-left-icon').click(function () {
                    // localStorage.setItem('rightMenuHidden', '0');
                    $("#right-menu-left-icon").css("display", "none");
                    $("#region-right-menu").removeClass('hide-section');
                    $("#region-main.has-blocks").css("width", "calc(100% - 375px)");
                });
            }
        };
        return learnbook;
    });
