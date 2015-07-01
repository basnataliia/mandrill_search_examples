<?php
require 'header.php';
?>
    <h1> Example1 - search result disaplyed in the table with specific fields </h1>
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
    //searches for messages with the specific sender 'mila.developer@gmail.com'
    $senders = array('mila.developer@gmail.com', 'akovalwm@gmail.com');
    //in my search there is no filter by api_keys
    $api_keys = '';
    //limits maximum number of search results to 50
    $limit = 10;
    //calls the Mandrill method with the parameters that are specified above
    //saves an array in the result
    $result = $mandrill->messages->search($query, $date_from, $date_to, $tags, $senders, $api_keys, $limit);
?>
    <div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Subject</th>
            <th>Send to</th>
            <th>Sender</th>
            <th>State</th>
            <th>Size</th>
        </tr>
        </thead>

        <?php
        //create an array of items
        $items = array();
        //loop trough an array to get sent messages' subjects, emails, senders, sizes and statuses
        foreach ($result as $key => $value) {
            echo '<tr>
                 <td>' . $value['subject'] . '</td>' .
                '<td>' . $value['email'] . '</td>' .
                '<td>' . $value['sender'] . '</td>'.
                '<td>' . $value['state'] . '</td>' ;

                foreach ($value['smtp_events'] as $event) {
                    if(isset($event['size'])) {
                    echo '<td>' . $event['size'] . '</td>';
                    }
                    else{
                    echo '<td>' . "not defined" . '</td>';
                    }
                }
            echo '</tr>';
        }
        ?>
    </table>
</div>


<?php
} catch (Mandrill_Error $e) {
    // Mandrill errors are thrown as exceptions
    echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
    throw $e;
}

require 'footer.php';

?>