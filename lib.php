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
 * Main library file for interfaces.
 *
 * @package    tool_seo
 * @copyright  2019 Andrew Madden <andrewmadden@catalyst-au.net>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/locallib.php');

/**
 * Callback that adds a custom html header tag to each page.
 *
 * @return string Valid html head content.
 * @since  Moodle 3.3
 */
function tool_seo_before_standard_html_head() {
    global $PAGE;

    if (tool_seo_is_url_excluded($PAGE->url->get_path())) {
        return '';
    }

    return '<meta name="robots" content="noindex, nofollow" />';
}
