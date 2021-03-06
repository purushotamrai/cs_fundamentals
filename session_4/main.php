<?php

require './HashTable.php';

$project = new HashTable();

// Set first 5 project values.
$project->set('id', 123);
$project->set('name', 'Novartis HCP');
$project->set('version', 'Drupal 7');
$project->set('team_size', 23);
$project->set('started', TRUE);

// Set next one as well.
$project->set('manager', 'Leena');

// Print current values;
echo 'ID: ' . $project->get('id') . '<br>';
echo 'Name: ' . $project->get('name') . '<br>';
echo 'Version: ' . $project->get('version') . '<br>';
echo 'Team Size: ' . $project->get('team_size') . '<br>';
echo 'Started: ' . $project->get('started') . '<br>';
echo 'Manager: ' . $project->get('manager') . '<br>';

echo '<br>';