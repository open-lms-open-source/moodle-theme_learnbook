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
use moodle_url;

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
            $PAGE->requires->js("/theme/$themename/javascript/login.js", true);
        }
        if ($PAGE->pagelayout == 'mydashboard') {
            $PAGE->requires->js("/theme/$themename/javascript/dashboard.js", true);
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

        foreach (\core_component::get_core_subsystems() as $name => $path) {
            if ($path) {
                $output .= component_callback($name, 'render_navbar_output', [$this], '');
            }
        }

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

        $context->logintitle = get_config('theme_learnbook', 'logintitle');
        $context->welcomemsg = get_config('theme_learnbook', 'welcomemsg');
        $context->welcometitle = get_config('theme_learnbook', 'welcometitle');

        //extra content for apollo template
        $context->has_welcome = true;
        $context->welcome_text_left = !empty(get_config('theme_learnbook', 'welcome_text_location')) && get_config('theme_learnbook', 'welcome_text_location') == 'right' ? false : true;
        if ((empty($context->welcomemsg) && empty($context->welcometitle)) || !get_config('theme_learnbook', 'display_welcome_text')) {
            $context->has_welcome = false;
        }

        //extra context for athena template
        $fs = get_file_storage();
        $files = $fs->get_area_files(\context_system::instance()->id, 'theme_learnbook', 'welcomeimg', 0);

        $welcomeImg = '';
        foreach ($files as $file) {
            $filename = $file->get_filename();
            if($filename != '.')
            {
                $url = moodle_url::make_pluginfile_url($file->get_contextid(), $file->get_component(), $file->get_filearea(), $file->get_itemid(), $file->get_filepath(), $file->get_filename());
                $welcomeImg = preg_replace('|^https?://|i', '//', $url->out(false));
                break;
            }
        }

        $context->welcomeimg = $welcomeImg;

        $selected_template = get_config('theme_learnbook', 'login_page_template');
        if ($selected_template === 'Apollo') {
            return $this->render_from_template('core/loginform', $context);
        } else if ($selected_template === 'Athena') {
            return $this->render_from_template('core/athena_loginform', $context);
        } else if ($selected_template === 'Learnbook') {
            return $this->render_from_template('core/learnbook_loginform', $context);
        }
    }

    /**
     * Wrapper for header elements.
     *
     * @return string HTML to display the main header.
     */
    public function full_header() {
        global $PAGE;

        $header = new \stdClass;
        $header->settingsmenu = $this->context_header_settings_menu();
        $header->contextheader = $this->context_header();
        $header->hasnavbar = empty($PAGE->layout_options['nonavbar']);
        $header->navbar = $this->navbar();
        $header->courseheader = $this->course_header();
        $header->pageheadingbutton = $this->page_heading_button();
//        if (empty($PAGE->layout_options['nonavbar'])) {
//            $html .= html_writer::start_div('clearfix w-100 pull-xs-left', array('id' => 'page-navbar'));
//            $html .= html_writer::tag('div', $this->navbar(), array('class' => 'breadcrumb-nav'));
//            $html .= html_writer::div($pageheadingbutton, 'breadcrumb-button pull-xs-right');
//            $html .= html_writer::end_div();
//        }
        return $this->render_from_template('core/full_header', $header);
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
