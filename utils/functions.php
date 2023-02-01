<?php
function getReservationDetails($post)
{
  if (isset($post['fName']) && isset($post['lName']) && isset($post['adress']) && isset($post['city']) && isset($post['cp']) && isset($post['region']) && isset($post['liaison']) && isset($post['traversee']) && isset($post['adult']) && isset($post['junior']) && isset($post['baby']) && isset($post['fourgon']) && isset($post['cc']) && isset($post['camion']) && isset($post['voiture4']) && isset($post['voiture5']) && isset($post['animals'])) {
    return $post;
  } else return null;
}
