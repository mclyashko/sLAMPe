<?php

foreach ($weather_report as $one_day_report) {
    echo <<<REPORT
        <div>
            <span>{$one_day_report[tableWeatherReportDay]}</span>
            <span>{$one_day_report[tableWeatherReportTemperature]}</span>
            <span>{$one_day_report[tableWeatherReportAbout]}</span>
        </div>
    REPORT;
}