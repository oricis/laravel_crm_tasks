# Table contents

## Table Attributes

> crm_expiration_times

Has the fields:
 - id
 - label
 - description (default NULL)

The "tasks time periods" (when a task ends), for example:
 - One hour
 - One day
 - ...

> crm_start_times

Has the fields:
 - id
 - label
 - description (default NULL)

The "tasks time periods" (when a task starts) can be:
 - Every 5th of March of each year
 - Every 5th of each month
 - Every Monday
 - Every day
 - Wednesday and Friday

> crm_task_groups

Has the fields:
 - id
 - title
 - description (default NULL)

> crm_tasks

Has the fields:
 - id
 - title
 - description (default NULL)
 - task_group_id (FK)
 - expiration_time_id (FK)
 - start_time_id (FK)
 - started_at (default NOW())
 - expired_at (nullable (no timelimit), default NOW() + 7 days)

> crm_time_filters

Has the fields:
 - id
 - label
 - description (default NULL)

The "time filters" to visualize the *uncompleted tasks* are:
 - TASKS TODAY
 - TASKS TOMORROW
 - TASKS NEXT WEEK
 - TASKS NEXT MONTH
 - TASKS NEXT (ALL)

> crm_user_tasks

Has the fields:
 - id
 - title
 - description (default NULL)
 - assigned_to (FK: user_id)
 - task_group_id (FK)
 - created_at (from tasks.started_at)
 - ended_at (define if the tasks is completed or not)
 - expired_at (from tasks.expired_at)

> crm_users

Has the fields:
 - id
 - name
 - email
 ...


***NOTE:** The "task duration" is determined by the "starting_at|created_at"*
*and "expired_at" attributes.*


***

[README](../../README.md)

[Docs](../docs.md)
