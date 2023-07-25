<?php
function validate_submission_time($attribute, $value, $parameters, $validator)
{
    $submissionTime = (int) $value;
    $currentTime = time();
    $timeDifference = $currentTime - $submissionTime;

    return $timeDifference >= $parameters[0];
}

?>