package org.tuefind.index;

import java.util.regex.Matcher;
import java.util.regex.Pattern;
import java.util.*;
import java.util.logging.Logger;
import org.marc4j.marc.DataField;
import org.marc4j.marc.Record;
import org.marc4j.marc.VariableField;
import org.marc4j.marc.*;


public class OCBBiblio extends TueFindBiblio {

    public Set<String> getYearsBasedOnRecordType(final Record record) {
        final Set<String> years = new LinkedHashSet<>();
        final Set<String> format = getFormats(record);

        // Match also the case of publication date transgressing one year
        // (Format YYYY/YY for older and Format YYYY/YYYY) for
        // newer entries
        final List<VariableField> _936Fields = record.getVariableFields("936");
        for (final VariableField _936VField : _936Fields) {
            final DataField _936Field = (DataField) _936VField;
            if (_936Field.getIndicator1() != 'u' || _936Field.getIndicator2() != 'w')
                continue;

            final Subfield jSubfield = _936Field.getSubfield('j');
            if (jSubfield != null) {
                String yearOrYearRange = jSubfield.getData();
                // Partly, we have additional text like "Post annum domini" in the front, so do away with that
                yearOrYearRange = yearOrYearRange.replaceAll("^[\\D\\[\\]]+", "");
                // Make sure we do away with brackets
                yearOrYearRange = yearOrYearRange.replaceAll("[\\[|\\]]", "");
                years.add(yearOrYearRange.length() > 4 ? yearOrYearRange.substring(0, 4) : yearOrYearRange);
            }
        }
        if (!years.isEmpty())
            return years;
        

        // Use the sort date given in the 008-Field
        final ControlField _008_field = (ControlField) record.getVariableField("008");
        if (_008_field == null) {
            logger.severe("getYearsBasedOnRecordType [Could not find 008 field for PPN:" + record.getControlNumber() + "]");
            return years;
        }
        final String _008FieldContents = _008_field.getData();
        final String yearExtracted = _008FieldContents.substring(7, 11);
        // Test whether we have a reasonable value
        final String year = checkValidYear(yearExtracted);
        // log error if year is empty or not a year like "19uu"
        if (year.isEmpty() && !VALID_YEAR_RANGE_PATTERN.matcher(yearExtracted).matches())
            logger.severe("getYearsBasedOnRecordType [\"" + yearExtracted + "\" is not a valid year for PPN "
                          + record.getControlNumber() + "]");
        else
            years.add(year);

        return years;
    }



    public String getPublicationSortYear(final Record record) {
        final Set<String> years = getYearsBasedOnRecordType(record);
        if (years.isEmpty())
            return "";

        return calculateLastPublicationYear(years);
    }
}

