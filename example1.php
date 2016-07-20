<?php
require 'header.php';
?>
<h1> Example2 - search result of recently sent messages </h1>
<?php
try {
    //initialize the Mandrill class with API KEY
    $mandrill = new Mandrill('cfwfZcDgFNU4CfaNlPVuDQ');
    //searches for messages where status is "sent"
    $query = 'state:sent';
    //searches for messages from '2015-06-29'
    $date_from = '2015-06-29';
    //searches for messages till '2015-07-02'
    $date_to = '2015-06-29';
    //in my search there is no filter by tags
    $tags = '';
    //searches for messages with the specific sender 'mila.developer@gmail.com'
    $senders = array('test@gmail.com', 'test2@gmail.com');
    //in my search there is no filter by api_keys
    $api_keys = '';
    //limits maximum number of search results to 50
    $limit = 10;


    $result = $mandrill->messages->search($query, $date_from, $date_to, $tags, $senders, $api_keys, $limit);

    echo '<pre>';
    print_r($result);
    echo '</pre>';

} catch (Mandrill_Error $e) {
    // Mandrill errors are thrown as exceptions
    echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
    throw $e;
}


require 'footer.php';

?>
