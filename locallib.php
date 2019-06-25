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
 * Checks whether the current URL is listed in the URLs to not be indexed in admin tools.
 *
 * @param $currentpath string The path component of the current URL to compare against.
 * @return bool Returns true if the URL should be indexable by search engines.
 */
function tool_seo_is_url_indexable($currentpath) {

    // Get the list of URLs to be excluded from the admin settings.
    try {
        $nonindexedurlstring = get_config('tool_seo', 'nonindexable');
    } catch(dml_exception $e) {
        return true;
    }

    $nonindexedurls = array_map('trim', explode(',', $nonindexedurlstring));

    // Checks if the current path is a non-indexable url, exactly.
    if (in_array($currentpath, $nonindexedurls)) {
        return false;
    }

    // Checks if a non-indexable url is part of the current path.
    foreach ($nonindexedurls as $nonindexedurl) {
        $nonindexedurl = preg_replace(["/\//", "/\./"], ["\/", "\."], $nonindexedurl); // Replace special char with escaped char.
        if (preg_match("/^.*".$nonindexedurl.".*$/", $currentpath)) {
            return false;
        }
    }

    return true;
}
