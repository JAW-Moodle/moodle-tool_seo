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

namespace tool_seo\local\hooks\output;

/**
 * Allows plugins to add any elements to the page <head> html tag
 *
 * @package   tool_seo
 * @author    Benjamin Walker (benjaminwalker@catalyst-au.net)
 * @copyright 2024 Catalyst IT
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class standard_head_html_prepend {

    /**
     * Callback that adds a custom html header tag to each page.
     *
     * @param \core\hook\output\standard_head_html_prepend $hook
     */
    public static function callback(\core\hook\output\standard_head_html_prepend $hook): void {
        GLOBAL $PAGE;

        // If URL should not be indexed, add the noindex meta tag to page.
        if (tool_seo_is_url_indexable($PAGE->url->get_path()) == false) {
            $hook->add_html('<meta name="robots" content="noindex, nofollow" />');
        }
    }
}
