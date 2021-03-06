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
 * @author     2020 Rob Hunt, eCreators <rob.hunt@ecreators.com.au>
 * @author     2020 Safat Shahin, eCreators <safat.shahin@ecreators.com.au>
 */

define(['jquery', 'core/ajax', 'core/str', 'core/config', 'core/templates', 'core/notification'],
    function ($, AJAX, str, mdlcfg, templates, notification) {
        var learnbook = {
            init: function () {
                function rightMenu (size) {
                    if (!size.matches) { // If media query matches
                        if ($('#region-right-menu').length) {
                            $("#right-menu-left-icon").show(500);
                        }
                        //for empty value
                        if (localStorage.getItem('rightMenuHidden') === null) {
                            localStorage.setItem('rightMenuHidden', '0');
                        }
                        //for right menu
                        if (localStorage.getItem('rightMenuHidden') === '0') {
                            $("#right-menu-left-icon").css('display', 'none');
                            $("#region-right-menu").show('slow');
                            $("#region-main.has-blocks").css("width", "calc(100% - 375px)");
                        }
                        $('#right-menu-right-icon').click(function () {
                            $("#region-right-menu").hide(300);
                            $("#region-main.has-blocks").css("transition", "none");
                            $("#region-main.has-blocks").animate({width: '100%'}, "slow");
                            $("#right-menu-left-icon").show(300);
                            localStorage.setItem('rightMenuHidden', '1');
                        });
                        $('#right-menu-left-icon').click(function () {
                            localStorage.setItem('rightMenuHidden', '0');
                            $("#right-menu-left-icon").hide(300);
                            $("#region-right-menu").show('slow');
                            $("#region-main.has-blocks").css("transition", "width 0.5s");
                            $("#region-main.has-blocks").css("width", "calc(100% - 375px)");
                        });
                    } else {
                        $("#right-menu-left-icon").css('display', 'none');
                        $("#right-menu-left-icon").css('display', 'none');
                        $("#region-main.has-blocks").css("width", "100%");
                    }
                }
                var size = window.matchMedia("(max-width: 1200px)");
                rightMenu(size);
                size.addListener(rightMenu);
                //Trick to insert some warning text into the customcert plugin.
                str.get_strings([
                    {'key': 'customcert_help_text', component: 'local_prgm'}
                ]).done(function (s) {
                    $('#page-mod-customcert-edit #fgroup_id_elementgroup').append('<div id = "customcert_help_text" class="col-md-9 offset-md-3 my-2">' + s[0] + '</div>');
                });
            }
        };
        return learnbook;
    });
