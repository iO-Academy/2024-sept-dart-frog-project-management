<?php


class DeadlineDateService
{
    public static function checkDeadlineOverdue(?string $deadlineDate)
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


}