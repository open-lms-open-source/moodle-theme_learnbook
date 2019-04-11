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

require_once $CFG->libdir . '/outputcomponents.php';
require_once $CFG->libdir . '/pagelib.php';

class core_renderer extends \theme_boost\output\core_renderer {

 
    /**
     * Wrapper for header elements.
     *
     * @return string HTML to display the main header.
     */
    public function full_header() {
        global $PAGE;
        
        $hideFrontPageTopBar = '';
        if ($PAGE->pagetype == 'my-index') {  //i.e frontpage/dashboard
            $currentURL = $PAGE->url->out();
            if(!strstr($currentURL, 'indexsys.php') )
                $hideFrontPageTopBar = 'hidden';               
        }
        
        $html = html_writer::start_tag('header', array('id' => 'page-header-new', 'class' => "row $hideFrontPageTopBar"));
        $html .= html_writer::start_div('col-xs-12');
        $html .= html_writer::start_div('card');
        $html .= html_writer::start_div('card-block');
        $html .= html_writer::div($this->context_header_settings_menu(), 'pull-xs-right context-header-settings-menu');
        $html .= html_writer::start_div('pull-xs-left');
        $html .= $this->context_header();
        $html .= html_writer::end_div();
        $pageheadingbutton = $this->page_heading_button();
        if (empty($PAGE->layout_options['nonavbar'])) {
            $html .= html_writer::start_div('clearfix w-100 pull-xs-left', array('id' => 'page-navbar'));
            $html .= html_writer::tag('div', $this->navbar(), array('class' => 'breadcrumb-nav'));
            $html .= html_writer::div($pageheadingbutton, 'breadcrumb-button pull-xs-right');
            $html .= html_writer::end_div();
        } else if ($pageheadingbutton) {
            $html .= html_writer::div($pageheadingbutton, 'breadcrumb-button nonavbar pull-xs-right');
        }
        $html .= html_writer::tag('div', $this->course_header(), array('id' => 'course-header'));
        $html .= html_writer::end_div();
        $html .= html_writer::end_div();
        $html .= html_writer::end_div();
        $html .= html_writer::end_tag('header');
        return $html;
    }

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


}
