<?php

readonly class TaskEntity
{
    public int $id;
    public int $project_id;
    public int $user_id;
    public string $name;
    public string $description;
    public int $estimate;
    public string $deadline;
}