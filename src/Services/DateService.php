<?php

class DateService
{
    public static function checkDeadlineOverdue(?string $deadlineDate): bool
    {
        if ($deadlineDate == NULL) {
            return false;
        }
        $deadline = strtotime($deadlineDate);
        $today = date('Y-m-d H:i:s');
        $todayDate = strtotime($today);
        if ($deadline < $todayDate) {
            return true;
        }
        return false;
    }

    public static function reformatDateUK(?string $dateinput): string
    {
        if($dateinput == null)
        {
            return 'N/A';
        }
        $date = new DateTimeImmutable($dateinput);
        $dateNewFormat = $date->format('d/m/y');
        return $dateNewFormat;
    }
    public static function reformatDateUS(?string $dateinput): string
    {
        if($dateinput == null)
        {
            return 'N/A';
        }
        $date = new DateTimeImmutable($dateinput);
        $dateNewFormat = $date->format('m-d-Y');
        return $dateNewFormat;
    }
}



