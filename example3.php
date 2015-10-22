<?php
require 'header.php';
?>
    <h1> Example3 - search result of recently sent messages </h1>
<?php
try {
    //initialize the Mandrill class with API KEY
    $mandrill = new Mandrill('cfwfZcDgFNU4CfaNlPVuDQ');
    //searches for messages where status is "sent"
    $query = 'state:sent';
    //searches for messages from '2015-06-29'
    $date_from = '2015-06-29';
    //searches for messages till '2015-07-02'
    $date_to = '2015-07-02';
    //in my search there is no filter by tags
    $tags = '';
    //searches for messages with the specific sender 'test@gmail.com'
    $senders = array('test@gmail.com');
    //in my search there is no filter by api_keys
    $api_keys = '';
    //limits maximum number of search results to 50
    $limit = 10;


    $result = $mandrill->messages->search($query, $date_from, $date_to, $tags, $senders, $api_keys, $limit);

        //loop trough an array to get sent messages' subjects, emails, senders, sizes and statuses
        foreach ($result as $key => $value) {
            //create an array of subjects
            $subjects[] = $value['subject'];
            //create an array of emails
            $emails[] = $value['email'];
            //create an array of senders
            $senders[] = $value['sender'];

            foreach ($value['smtp_events'] as $event) {
                 $event['size'] ;
            }

            if(isset($event['size'])) {
                //create an array of sizes
                $sizes[] = $event['size'];
            }
            else{
                $sizes[] = "not defined";
            }
        }

            //returns an array using the values of "subjects" array as keys and their frequency in "subjects" array as values.
            $newSubjects = array_count_values($subjects);
            //returns an array using the values of "emails" array as keys and their frequency in "emails" array as values.
            $newEmails = array_count_values($emails);
            //returns an array using the values of "senders" array as keys and their frequency in "senders" array as values.
            $newSenders = array_count_values($senders);
            //returns an array using the values of "sizes" array as keys and their frequency in "sizes" array as values.
            $newSizes = array_count_values($sizes);


            //display the number of different values in the "newSubjects" array
            echo "<br> Subjects: <br>";
            foreach ($newSubjects as $key => $count_value) {
                echo "$key - <strong>$count_value</strong> <br />";
            }
            echo "<hr><br>";

            //display the number of different values in the "newEmails" array
            echo "Send to: <br>";
            foreach ($newEmails as $key => $count_value) {
                echo "$key - <strong>$count_value</strong> <br />";
            }
            echo "<hr><br>";

            //display the number of different values in the "newSenders" array
            echo "Senders: <br>";
            foreach ($newSenders as $key => $count_value) {
                echo "$key - <strong>$count_value</strong> <br />";
            }
            echo "<hr><br>";

            //display the number of different values in the "newSizes" array
            echo "Email sizes: <br>";
            foreach ($newSizes as $key => $count_value) {
                echo "$key - <strong>$count_value</strong> <br />";
            }
            echo "<hr><br>";

} catch (Mandrill_Error $e) {
    // Mandrill errors are thrown as exceptions
    echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
    throw $e;
}


require 'footer.php';

?>
