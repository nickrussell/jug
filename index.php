<?php

require __DIR__ . '/vendor/autoload.php';

use JiraRestApi\JiraException;
use JiraRestApi\Group\GroupService;

try {

  // Defaults.
  $groupname = 'Test-Group-Name';
  $includeInactiveUsers = FALSE;
  $startAt = 0;
  $maxResults = 50;

  // Set up query params based on CLI values passed in.
  if (php_sapi_name() == 'cli') {
    $groupname = isset($argv[1]) ? $argv[1] : '';
    $includeInactiveUsers = (isset($argv[2]) && $argv[2] === 1) ? TRUE : FALSE;
    $startAt = isset($argv[3]) ? $argv[3] : 0;
    $maxResults = isset($argv[4]) ? $argv[4] : 50;
  }

  $queryParam = [
    'groupname' => $groupname,
    'includeInactiveUsers' => $includeInactiveUsers,
    'startAt' => $startAt,
    'maxResults' => $maxResults,
  ];

  $gs = new GroupService();

  $ret = $gs->getMembers($queryParam);

  // print all users in the group
  $group_users = array(
    array('displayName', 'name', 'emailAddress'),
  );
  foreach($ret->values as $user) {
    $group_users[$user->key]['displayName'] = $user->displayName;
    $group_users[$user->key]['name'] = $user->name;
    $group_users[$user->key]['emailAddress'] = $user->emailAddress;
  }

  if (!file_exists('csv')) {
    mkdir('csv', 0777);
  }

  if (!empty($group_users)) {
    $filename = $queryParam['groupname'] . '.csv';
    $fp = fopen('csv/' . $filename, 'w');

    foreach ($group_users as $fields) {
      fputcsv($fp, $fields);
    }

    fclose($fp);

    print "The file {$filename} has been created successfully.\n";
  }
} catch (JiraException $e) {
  print("Error Occured! " . $e->getMessage());
}