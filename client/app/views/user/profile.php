<?php
if (!empty($data['user'])) {
	print_r(json_encode($data['user']));
} else {
	echo 'Error: User controller could not load the data';
}
;?>
