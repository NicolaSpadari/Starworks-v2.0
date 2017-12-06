<?php
    include_once 'connect.php';
    include_once 'Mobile_Detect.php';
    
    /* SLIDESHOW */
    function getSlideshow(){
        connection();
        global $connect;
        $detect = new Mobile_Detect();
        
        $resultId = mysqli_query($connect, "SELECT id FROM slideshow");
        if (!$resultId) {
            die(mysql_error());
        }
        if ($detect->isMobile()){
            echo "<ol class='carousel-indicators mobile-indicators'>";
        }
        else{
            echo "<ol class='carousel-indicators pc-indicators'>";            
        }
        while ($row = mysqli_fetch_array($resultId)) {
            $indicators[] = $row['id'];
        }
        fixIndicators(count($indicators));
        echo "</ol><div class='carousel-inner' role='listbox'>";
        $resultSlide = mysqli_query($connect, "SELECT * FROM slideshow");
        if (!$resultSlide) {
            die(mysql_error());
        }
        while ($row = mysqli_fetch_array($resultSlide)) {
            createSlides($row['id'], $row['img'], $row['caption']);
        }
        echo "</div>";
        
        mysqli_close($connect);
    }
    function createIndicators($num){
        if($num === 0){
            echo "<li data-target='#slideshowIndicators' data-slide-to='$num' class='indic active'></li>";
        }else{
            echo "<li data-target='#slideshowIndicators' data-slide-to='$num' class='indic'></li>";
        }
    }
    function fixIndicators($num){
        for($i = 0; $i < $num; $i++){
            createIndicators($i);
        }
    }
    function createSlides($id, $imgUrl, $text){
        $id--;
        $detect = new Mobile_Detect();
        if($id === 0){
            echo "<div class='carousel-item active' style='background-image: url(\"$imgUrl\")'>";
        }else{
            echo "<div class='carousel-item' style='background-image: url(\"$imgUrl\")'>";
        }
        if ($detect->isMobile()){
            echo "<div class='carousel-caption mobile-caption'><h3><b>$text</b></h3></div>";
        }
        else{
            echo "<div class='carousel-caption pc-caption'><h3><b>$text</b></h3></div>";       
        }
        echo "</div>";
    }
    
    /* EVENTS */
    function getEvents(){
        connection();
        global $connect;
        $result = mysqli_query($connect, "SELECT * FROM events");
        if (!$result) {
            die(mysql_error());
        }
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                createEvents($row['title'], $row['code'], $row['date'], $row['time'], $row['cover']);
            }
        }else{
            emptyDiv();
        }
        
        mysqli_close($connect);
    }
    function createEvents($title, $code, $date, $time, $cover){
        $timeClean = date('g:ia', strtotime($time));
        echo "<div class='col-xs-12 col-md-6 col-lg-4'>
                <div class='event'>
                    <h3 class='eventTitle'>$title</h3>
                    <div class='ticket'>
                        <div class='ticketCover' onclick=\"fatsomaEventsWidget.showEvent('$code')\" href='#event_id=$code'>
                            <img class='img-fluid img-thumbnail ticketImage' src='$cover'>
                            <div class='middle'>
                                <div class='text'>Buy tickets</div>
                            </div>
                        </div>
                        <div class='ticketTime'>
                            <p>$date | $timeClean</p>
                        </div>
                    </div>
                </div>
            </div>";
    }

    /* VIDEOS */
    function getVideos() {
        $channel_id = 'UCeUIxUyTQVxeUvZvbp8xdaA';
        $xml = simplexml_load_file(sprintf('https://www.youtube.com/feeds/videos.xml?channel_id=%s', $channel_id));

        echo "<div class='row SWvideo'>";
        for ($i = 0; $i < 4; $i++) {
            if (!empty($xml->entry[$i]->children('yt', true)->videoId[0])) {
                $id[$i] = $xml->entry[$i]->children('yt', true)->videoId[0];
            }
            echo "<div class='col-sm-6'><div class='embed-responsive embed-responsive-16by9'>";
            echo "<iframe class='embed-responsive-item' src='//www.youtube.com/embed/$id[$i]'></iframe>";
            echo "</div></div>";
        }
        echo "</div>";
    }
    
    /* FAQS */
    function getFaqs() {
        connection();
        global $connect;
        $result = mysqli_query($connect, "SELECT question, answer FROM faq");
        if (!$result) {
            die(mysql_error());
        }
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                createFaq($row['question'], $row['answer']);
            }
        }
        
        mysqli_close($connect);
    }    
    function createFaq($question, $answer){
        echo "<div class='row mb-1'>";
        echo "<div class='col-12 bg-dark-custom text-white py-2 px-4 mb-1 faqQuestion'><i class='fa fa-caret-right'></i><span class='faqExt'></span><span class='faqInt'>$question</span></div>";
        echo "<div class='col-12 text-justify collapsibleItem'><p class='m-0'>$answer</p></div>";
        echo "</div>";
    }
    
    /* INFOS */
    function getInfos() {
        connection();
        global $connect;
        $result = mysqli_query($connect, "SELECT address, phone, mail FROM info LIMIT 1");
        if (!$result) {
            die(mysql_error());
        }
        while ($row = mysqli_fetch_array($result)) {
            createInfoPanel($row['address'], $row['phone'], $row['mail']);
        }
        
        mysqli_close($connect);
    }
    function createInfoPanel($address, $phone, $mail){
        echo "<i class='fa fa-caret-right' aria-hidden='true'></i> $address<br>";
        echo "<i class='fa fa-caret-right' aria-hidden='true'></i> Phone: $phone<br>";
        echo "<i class='fa fa-caret-right' aria-hidden='true'></i> Email: <a href='mailto:$mail' target='_top'>$mail</a>";
    }
    
    /* GALLERY */
    function getAlbums(){
        connection();
        global $connect;
        $result = mysqli_query($connect, "SELECT * FROM gallery");
        if (!$result){
            die(mysql_error());
        }
        while($row = mysqli_fetch_array($result)){
            createAlbums($row['id'], $row['title'], $row['cover'], $row['date']);
        }
        
        mysqli_close($connect);
    }
    function createAlbums($id, $title, $img, $date){
        echo   "<div class='col-6 col-md-3'>
                    <div id='card$id' class='card album-card' onclick='populateModal($id)'>
                        <img class='card-img-top' src='$img'>
                        <div class='card-block'>
                            <h4 class='card-title'>$title</h4>
                            <p class='card-text'><small class='text-muted'>$date</small></p>
                        </div>
                    </div>
                </div>";
    }
    
    /* GENERIC EMPTY */
    function emptyDiv(){
        echo "<div class='col-10 text-center'>
                <div class='alert alert-warning'>
                    <i class='fa fa-exclamation-circle' aria-hidden='true'></i> No data found
                </div>
             </div>";
    }
    
    /* CALL FUNCTION THROUGH AJAX */
    if(isset($_POST['function']) == 'getPhotos'){
        getPhotos($_POST['id']);
    }
    function getPhotos($id){
        connection();
        global $connect;
        $result = mysqli_query($connect, "SELECT link FROM photo WHERE albumId = '$id'");
        if (!$result){
            die(mysql_error());
        }
        while($row = mysqli_fetch_array($result)){
            $img = $row['link'];
            echo "<img src='$img' class='col-2 img-fluid rounded' data-action='zoom'>";
        }
        
        mysqli_close($connect);
    }
?>