<?php
	echo 'item:   ';
	echo '<br>';
	foreach ($item as $row) {
		echo $row->item_name;
		echo '<br>';
	}

	echo 'shop:   ';
	echo '<br>';
	foreach ($shop as $row) {
		echo $row->shop_name;
		echo '<br>';
	}

	echo 'user:   ';
	echo '<br>';
	foreach ($user as $row) {
		echo $row->user_name;
		echo '<br>';
	}