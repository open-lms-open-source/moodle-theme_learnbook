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
 * Theme Learnbook - library file
 *
 * @package    theme_learnbook
 * @author     2019 Chris Megahan, eCreators <chris@ecreators.com.au>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Returns the main SCSS content.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_learnbook_get_main_scss_content($theme) {
    global $CFG;
    $scss = '';
    $filename = !empty($theme->settings->preset) ? $theme->settings->preset : null;
    $fs = get_file_storage();
    $context = context_system::instance();
    if ($filename == 'default.scss') {
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');
    } else if ($filename == 'plain.scss') {
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/plain.scss');
    } else if ($filename && ($presetfile = $fs->get_file($context->id, 'theme_learnbook', 'preset', 0, '/', $filename))) {
        $scss .= $presetfile->get_content();
    } else {
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');
    }
    $pre = file_get_contents($CFG->dirroot . '/theme/learnbook/scss/pre.scss');
    $post = file_get_contents($CFG->dirroot . '/theme/learnbook/scss/post.scss');

    $selected_template = get_config('theme_learnbook', 'login_page_template');
    if ($selected_template === 'Apollo') {
        $login = file_get_contents($CFG->dirroot . '/theme/learnbook/scss/apollo_login.scss');
    } else if ($selected_template === 'Athena') {
        $login = file_get_contents($CFG->dirroot . '/theme/learnbook/scss/athena_login.scss');
    } else if ($selected_template === 'Learnbook') {
        $login = file_get_contents($CFG->dirroot . '/theme/learnbook/scss/learnbook_login.scss');
    }

    return $pre . "\n" . $scss . "\n" . $post . "\n" . $login;
}

/**
 * Replaces variables in the SCSS with their values from the theme settings
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_learnbook_get_pre_scss($theme) {
    global $CFG;

    $scss = '';
    $configurable = [
        'brandcolor' => ['brandcolor'],
        'headercolor' => ['headercolor'],
        'headertextcolor' => ['headertextcolor'],
        'leftmenuheadercolor' => ['leftmenuheadercolor'],
        'leftmenuheadertextcolor' => ['leftmenuheadertextcolor'],
        'leftmenumainitemcolor' => ['leftmenumainitemcolor'],
        'leftmenuitemhovercolor' => ['leftmenuitemhovercolor'],
        'leftmenuitemstextcolor' => ['leftmenuitemstextcolor'],
        'leftmenusubitemcolor' => ['leftmenusubitemcolor'],
        'sectionheadercolor' => ['sectionheadercolor'],
        'sectionhovercolor' => ['sectionhovercolor'],
        'coursetilecolor' => ['coursetilecolor'],
        'coursetiletextcolor' => ['coursetiletextcolor'],
        'coursebtncolor' => ['coursebtncolor'],
        'coursebtnhovercolor' => ['coursebtnhovercolor'],
        'footercolor' => ['footercolor'],
    ];

    foreach ($configurable as $configkey => $targets) {
        $value = isset($theme->settings->{$configkey}) ? $theme->settings->{$configkey} : null;
        if (empty($value)) {
            continue;
        }
        array_map(function($target) use (&$scss, $value) {
            $scss .= '$' . $target . ': ' . $value . ";\n";
        }, (array) $targets);
    }

    if (!empty($theme->settings->scsspre)) {
        $scss .= $theme->settings->scsspre;
    }

    return $scss;
}

/**
 * Returns the a file
 *
 * @return setting_file_serve
 */
function theme_learnbook_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array()) {
    if ($context->contextlevel == CONTEXT_SYSTEM && ($filearea === 'logo' || $filearea === 'backgroundimage' || $filearea === 'favicon') || $filearea === 'slideshow' || $filearea === 'welcomeimg') {
        $theme = theme_config::load('learnbook');
        if (!array_key_exists('cacheability', $options)) {
            $options['cacheability'] = 'public';
        }
        return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
    } else {
        send_file_not_found();
    }
}

/**
 * routes profile pages
 * switch between moodle default and learnbook
 */
function routes() {
    global $CFG;
    $routes = array();
    $theme = theme_config::load('learnbook');
    $routes['/user/view.php'] = '/local/profile/index.php';
    $routes['/user/profile.php'] = '/local/profile/index.php';
    if (empty($theme->settings->learnbook_user_profile)) {
        unset($routes['/user/view.php']);
        unset($routes['/user/profile.php']);
    }
    if (isset($routes[$_SERVER['SCRIPT_NAME']])) {
        $uri = $CFG->wwwroot . $routes[$_SERVER['SCRIPT_NAME']]. '?'.$_SERVER['QUERY_STRING'];
        if (headers_sent()) {
            redirect($uri);
        } else {
            header('Location: ' . $uri);
        }
        exit;
    }
}

routes();


//class theme_learnbook {
//
//    public static function routes() {
//        global $CFG;
//
//        $routes = array();
//        $theme = theme_config::load('learnbook');
//
//        $routes['/user/view.php'] = '/local/profile/index.php';
//        $routes['/user/profile.php'] = '/local/profile/index.php';
//        if (empty($theme->settings->learnbook_user_profile)) {
//            unset($routes['/user/view.php']);
//            unset($routes['/user/profile.php']);
//        }
//
//        if (isset($routes[$_SERVER['SCRIPT_NAME']])) {
//            $uri = $CFG->wwwroot . $routes[$_SERVER['SCRIPT_NAME']]. '?'.$_SERVER['QUERY_STRING'];
//
//            if (headers_sent()) {
//                redirect($uri);
//            } else {
//                header('Location: ' . $uri);
//            }
//            exit;
//        }
//    }
//}
//
//theme_learnbook::routes();
