<?php

defined('I_AM_TELAEN') or die('Direct access not permitted');

    $auth['last-update'] = time();
    if ($quota_limit) {
        for ($n = 0;$n<count($boxes);$n++) {
            $entry = $boxes[$n]['name'];
            $merged_array = array();
            $merged_returnarray = array();
            if ($entry == 'inbox') {
                /*
                 * Only process the inbox once for the spam-/inbox folder
                 */
                /*
                 * Sort the arrays and fit them together again.
                 */
                $merged_array = array_merge((array) $mbox['headers']['inbox'], (array) $mbox['headers']['spam']);
                Telaen::array_qsort2int($merged_array, 'mnum', 'ASC');

                $merged_returnarray = $TLN->mail_list_msgs('inbox', $merged_array, $start_pos, $reg_pp);

                /*
                 * Keep the old array if we still got the same messages on the server
                 * as we had in our previous messagelist. Only get the new lists if something
                 * has changed.
                 */
                if ($merged_returnarray[2] == 1) {
                    $mbox['headers']['inbox'] = $merged_returnarray[0];
                    $mbox['headers']['spam'] = $merged_returnarray[1];
                }
            } elseif ($entry == 'spam') {
                ;
            } else {
                $merged_returnarray = $TLN->mail_list_msgs($entry, $mbox['headers'][$entry], $start_pos, $reg_pp);
                $mbox['headers'][$entry] = $merged_returnarray[0];
            }
            unset($merged_array);
            unset($merged_returnarray);
        }
    } else { // no quota, get single folder

        $returnarray = array(); // ensure
        // if inbox or spam merge the 2 current folders
        if ($folder == 'inbox' || $folder == 'spam') {
            /*
             * Sort the arrays and fit them together again.
             */
            $merged_array = array_merge((array) $mbox['headers']['inbox'], (array) $mbox['headers']['spam']);
            Telaen::array_qsort2int($merged_array, 'mnum', 'ASC');
            $returnarray = $TLN->mail_list_msgs('inbox', $merged_array, $start_pos, $reg_pp);

            /*
             * Keep the old array if we still got the same messages on the server
             * as we had in our previous messagelist. Only get the new lists if something
             * has changed or we get an EMPTY msg list on refresh
             */
            if ($returnarray[2] == 1) {
                $mbox['headers']['inbox'] = $returnarray[0];
                $mbox['headers']['spam'] = $returnarray[1];
            }
        } else {
            $returnarray = $TLN->mail_list_msgs($folder, $mbox['headers'][$folder], $start_pos, $reg_pp);
            $mbox['headers'][$folder] = $returnarray[0];
        }
        unset($merged_array);
        unset($returnarray);
    }
    // load the headers for the folder
    $headers = $mbox['headers'][$folder];
