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
 * This is a Moodle file.
 *
 * This is a longer description of the file.
 *
 * @package    mod_mymodule
 * @author     Andrew Madden <andrewmadden@catalyst-au.net>
 * @copyright  2019 Catalyst IT
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Checks whether the current URL is listed in the excluded URLs in the admin tools.
 *
 * @param $currentpath string The path component of the current URL to compare against.
 * @return bool
 */
function tool_seo_is_url_excluded($currentpath) {

    // Get the list of URLs to be excluded from the admin settings.
    try {
        $excludedurlstring = get_config('tool_seo', 'noindexexcluded');
    } catch(dml_exception $e) {
        return false;
    }

    $excludedurls = array_map('trim', explode(',', $excludedurlstring));

    if (in_array($currentpath, $excludedurls)) {
        return true;
    }
    return false;
}

/**
 * Checks whether the current page type is listed in the excluded page types in the admin tools.
 *
 * @return bool
 */
function tool_seo_is_current_page_excluded() {
    global $PAGE;

    // Pages to exclude from the search engine noindex block.
    $excludedpages = ['test'];

    // Check if the current page type matches any of the excluded page types.
    // TODO: Should this be case insensitive?
    if (preg_grep("/^(.*\\-)?".$PAGE->pagetype."(\\-.*)?$/", $excludedpages)) {
        return true;
    }
    return false;
}
