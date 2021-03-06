/**
 * @package PublishPress
 * @author PublishPress
 *
 * Copyright (c) 2018 PublishPress
 *
 * ------------------------------------------------------------------------------
 * Based on Edit Flow
 * Author: Daniel Bachhuber, Scott Bressler, Mohammad Jangda, Automattic, and
 * others
 * Copyright (c) 2009-2016 Mohammad Jangda, Daniel Bachhuber, et al.
 * ------------------------------------------------------------------------------
 *
 * This file is part of PublishPress
 *
 * PublishPress is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * PublishPress is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with PublishPress.  If not, see <http://www.gnu.org/licenses/>.
 */

jQuery(document).ready(function ($) {
    $('.date-time-pick').datetimepicker({
        dateFormat: objectL10ndate.date_format,
        firstDay: pp_week_first_day,
        alwaysSetTime: false,
        controlType: 'select'
    });

    $('.date-pick').each(function() {
        var self = $(this);

        var datePickerOptions = {
            dateFormat: objectL10ndate.date_format,
            firstDay: pp_week_first_day,
        };

        var altFieldName = self.attr('data-alt-field');
        if (altFieldName.length > 0) {
            datePickerOptions.altField = 'input[name="'+ altFieldName +'"]';
            datePickerOptions.altFormat = self.attr('data-alt-format');
        }

        self.datepicker(datePickerOptions);
    });
});
