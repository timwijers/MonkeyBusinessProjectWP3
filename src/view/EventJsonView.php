<?php
/**
 * Created by PhpStorm.
 * User: kimprzybylski
 * Date: 17/05/17
 * Time: 18:36
 * bron:excercise2
 */

namespace view;


class EventJsonView implements View
{
    public function show(array $data)
    {
        header('Content-Type: application/json');

        if (isset($data['event'])) {
            $event = $data['event'];
            echo json_encode(['Id' => $event->getId(), 'Name' => $event->getName(), 'StartDate' => $event->getStartDate(), 'EndDate' => $event->getEndDate(), 'PersonId' => $event->getPersonId()]);
        } else {
            echo '{}';
        }
    }
}