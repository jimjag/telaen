<?

	$sess["last-update"] = time();
	if($quota_limit) {
		for($n=0;$n<count($boxes);$n++) {
			$entry = $boxes[$n]["name"];
			$merged_array = Array();
			$merged_returnarray = Array();
			if (strtolower($entry) == "inbox") {
				/*
				 * Only process the inbox once for the spam-/inbox folder
				 */
				/*
				 * Sort the arrays and fit them together again.
				 */
				$merged_array = array_merge($sess["headers"][base64_encode("inbox")], $sess["headers"][base64_encode("spam")]);
				array_qsort2($merged_array,"msg",$sortorder);

				$merged_returnarray = $UM->mail_list_msgs("INBOX", $merged_array);

				/*
				 * Keep the old array if we still got the same messages on the server
				 * as we had in our previous messagelist. Only get the new lists if something
				 * has changed.
				 */
				if ($merged_returnarray[2]) {
					$sess["headers"][base64_encode("inbox")] = $merged_returnarray[0];
					$sess["headers"][base64_encode("spam")] = $merged_returnarray[1];
				}
			} elseif (strtolower($entry) == "spam") {
				;
			} else {
				$merged_returnarray = $UM->mail_list_msgs($entry, $sess["headers"][base64_encode(strtolower($entry))]);
				$sess["headers"][base64_encode(strtolower($entry))] = $merged_returnarray[0];
			}
			unset($merged_array);
			unset($merged_returnarray);
		}
	} else {
		$sess["headers"][$folder_key] = $UM->mail_list_msgs($folder, $sess["headers"][$folder_key]);
	}
	$headers = $sess["headers"][$folder_key];
?>
