//ranking routes
$route['ranking/(:any)'] = 'ranking/view/$1';
$route['ranking'] = 'ranking';

//medical routes
$route['medical/(:any)'] = 'medical/view/$1';
$route['medical'] = 'medical';

//leave routes
//$route['leave/addemployee'] = 'leave/addemployee';
$route['leave/delete_holiday/(:any)'] = 'leave/delete_holiday/$1';
$route['leave/add_holiday'] = 'leave/add_holiday';
$route['leave/edit_holiday/(:any)'] = 'leave/edit_holiday/$1';
$route['leave/holidays'] = 'leave/holidays';
$route['leave/delete_leave_type/(:any)'] = 'leave/delete_leave_type/$1';
$route['leave/add_leave_type'] = 'leave/add_leave_type';
$route['leave/edit_leave_type/(:num)'] = 'leave/edit_leave_type/$1';
$route['leave/leave_type'] = 'leave/leave_type';
$route['leave/leave_settings'] = 'leave/leave_settings';
$route['leave/(:any)'] = 'leave/view/$1';
$route['leave'] = 'leave';