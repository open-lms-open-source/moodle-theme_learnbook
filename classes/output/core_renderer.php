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
 * Theme Learnbook - version file
 *
 * @package    theme_learnbook
 * @author     2019 Chris Megahan, eCreators <chris@ecreators.com.au>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_learnbook\output;
defined('MOODLE_INTERNAL') || die;

use html_writer;
use context_course;

require_once $CFG->libdir . '/outputcomponents.php';
require_once $CFG->libdir . '/pagelib.php';

class core_renderer extends \theme_boost\output\core_renderer {

    /**
     * The standard tags that should be included in the <head> tag
     * including a meta description for the front page
     *
     * @return string HTML fragment.
     */
    public function standard_head_html() {
        global $SITE, $PAGE;

        $PAGE->requires->jquery();
        $themename = $PAGE->theme->name;
        $PAGE->requires->js("/theme/$themename/javascript/tooltips.js");   
        
        if ($PAGE->pagelayout == 'login') {            
            $PAGE->requires->js("/theme/$themename/javascript/jquery.backstretch.js", true);              
        }
        
        $output = parent::standard_head_html();
        if ($PAGE->pagelayout == 'frontpage') {
            $summary = s(strip_tags(format_text($SITE->summary, FORMAT_HTML)));
            if (!empty($summary)) {
                $output .= "<meta name=\"description\" content=\"$summary\" />\n";
            }
        }

        return $output;
    }


    public function navbar_plugin_output() {
        $output = '';
        
    	if ($pluginsfunction = get_plugins_with_function('render_navbar_output')) {
    		foreach ($pluginsfunction as $plugintype => $plugins) {
    			foreach ($plugins as $pluginfunction) {
    				$output .= $pluginfunction($this);
    			}
    		}
        }
        
    	$find = ['fa-bell ', 'fa-comment '];
    	$replace = ['fa-bell-o ', 'fa-commenting-o '];
    	$output = str_replace($find, $replace, $output);
    	return $output;
    }

    public function get_category_color_by_id($category_id = NULL) {
		$color = '';
		if (empty($category_id)) {
			return $color;
		}
		return get_config('theme_learnbook', 'sectionhovercolor');
	}

    public function render_login(\core_auth\output\login $form) {
        global $CFG, $SITE;

        $context = $form->export_for_template($this);

        // Override because rendering is not supported in template yet.
        if ($CFG->rememberusername == 0) {
            $context->cookieshelpiconformatted = $this->help_icon('cookiesenabledonlysession');
        } else {
            $context->cookieshelpiconformatted = $this->help_icon('cookiesenabled');
        }
        $context->errorformatted = $this->error_text($context->error);
        $url = $this->get_logo_url();
        if ($url) {
            $url = $url->out(false);
        }
        $context->logourl = $url;
        $context->sitename = format_string($SITE->fullname, true,
            ['context' => context_course::instance(SITEID), "escape" => false]);

        $context->welcomemsg = get_config('theme_learnbook', 'welcomemsg');
        $context->welcometitle = get_config('theme_learnbook', 'welcometitle');
        $context->has_welcome = true;
        if (empty($context->welcomemsg) && empty($context->welcometitle)) {
            $context->has_welcome = false;
        }

        return $this->render_from_template('core/loginform', $context);
    }

    /**
     * Returns the url of the custom favicon.
     */
    public function favicon() {
        // Allow customized favicon from settings.
        $url = $this->page->theme->setting_file_url('favicon', 'favicon');
        return empty($url) ? parent::favicon() : $url;
    }

}
