<?php
    session_start();
    include_once 'Include/functions.php';
    include_once 'Include/Mobile_Detect.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Starworks Warehouse</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="theme-color" content="#000" />
        <link href="CSS/bootstrap.min.css" rel="stylesheet">
        <link href="CSS/zoom.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <?php
            $detect = new Mobile_Detect();
            if ($detect->isMobile()) {
                echo "<link href='Images/favicon-mobile.png' rel='shortcut icon' type='image/png' sizes='72x72'/>";
            } else {
                echo "<link href='Images/favicon.png' rel='shortcut icon' type='image/png' sizes='72x72'/>";
            }
        ?>
        <link href="CSS/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php include_once 'Include/svg-animation.html'; ?>
        
        <nav id="menu">
            <?php include_once 'Include/header.html'; ?>
        </nav>
        
        <div id="visibleContent">
            <!-- CENTER -->
            <section id="slideshow" data-top="0" data-bottom="0" data-left="0" data-right="0">
                <div class="plateWrapper">
                    <h3>Home</h3>
                </div>
                <div class="content no-scroll">
                    <div id="slideshowIndicators" class="carousel slide" data-ride="carousel">
                        <?php getSlideshow(); ?>
                        <a class="carousel-control-prev" href="#slideshowIndicators" role="button" data-slide="prev">
                            <i class="fa fa-3x fa-chevron-circle-left" aria-hidden="true"></i>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#slideshowIndicators" role="button" data-slide="next">
                            <i class="fa fa-3x fa-chevron-circle-right" aria-hidden="true"></i>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </section>

            <!-- CENTER LEFT -->
            <section id="events" data-top="0" data-bottom="0" data-left="-100" data-right="100">
                <div class="plateWrapper">
                    <h3>Events</h3>
                </div>
                <div class="content">
                    <div class="container">                
                        <p id="line" class="lead">Upcoming events</p>
                        <div class="row">
                            <div class="widget-iframe-container">
                                <script src="https://www.fatsoma.com/widgets/scripts/events.js" data-reference="3a13e27b-2b18-4869-b381-132c23351666"></script>                                                      
                            </div>
                            <?php getEvents(); ?>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CENTER RIGHT -->
            <section id="videos" data-top="0" data-bottom="0" data-left="100" data-right="-100">
                <div class="plateWrapper">
                    <h3>Latest videos</h3>
                </div>
                <div class="content">
                    <div class="container">
                        <p id="line" class="lead">Latest videos</p>
                        <div class="row justify-content-center">
                            <div class="col-12 d-block d-md-none">
                                <a class="btn btn-outline-danger btn-block" href="https://www.youtube.com/channel/UCeUIxUyTQVxeUvZvbp8xdaA/videos" target="_blank" role="button">
                                    <i class="fa fa-2x fa-youtube-play" aria-hidden="true" style="vertical-align: middle;"></i>
                                    &nbsp;Watch all videos on YouTube
                                </a>
                            </div>
                            <div class="col-7 d-none d-md-block">
                                <a class="btn btn-outline-danger btn-block" href="https://www.youtube.com/channel/UCeUIxUyTQVxeUvZvbp8xdaA/videos" target="_blank" role="button">
                                    <i class="fa fa-2x fa-youtube-play" aria-hidden="true" style="vertical-align: middle;"></i>
                                    &nbsp;Watch all videos on YouTube
                                </a>
                            </div>
                        </div>
                        <?php getVideos(); ?>
                    </div>
                </div>
            </section>

            <!-- CENTER TOP -->
            <section id="gallery" data-top="-100" data-bottom="100" data-left="0" data-right="0">
                <div class="plateWrapper">
                    <h3>Gallery</h3>
                </div>
                <div class="content">
                    <div class="container">
                        <p id="line" class="lead">Gallery</p>
                        <div class="container pb-5">
                            <div class="row text-center">
                                <?php getAlbums(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- TOP LEFT -->
            <section id="faqs" data-top="-100" data-bottom="100" data-left="-100" data-right="100">
                <div class="plateWrapper">
                    <h3>Faqs</h3>
                </div>
                <div class="content">
                    <div class="container">
                        <p id="line" class="lead">Faqs</p>
                        <?php getFaqs(); ?>
                    </div>
                </div>
            </section>

            <!-- TOP RIGHT -->
            <section id="parking" data-top="-100" data-bottom="100" data-left="100" data-right="-100">
                <div class="plateWrapper">
                    <h3>Parking</h3>
                </div>
                <div class="content">
                    <div class="container">
                        <p id="line" class="lead">Parking</p>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d2883.1790487938206!2d-2.1302058613976356!3d52.57946780045451!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sparking+near+starworks+warehouse!5e0!3m2!1sit!2sit!4v1507287909184" width="100%" height="610" frameborder="0" style="border:0" allowfullscreen></iframe>  
                    </div>
                </div>
            </section>

            <!-- CENTER BOTTOM -->
            <section id="location" data-top="100" data-bottom="-100" data-left="0" data-right="0">
                <div class="plateWrapper">
                    <h3>Location</h3>
                </div>
                <div class="content">
                    <div class="container">
                        <p id="line" class="lead">Location</p>
                        <div class="row">
                            <div class="col-sm-4">
                                <h3 class="section-title">Location & contact</h3>
                                <address>
                                    <p>
                                        <i class="fa fa-caret-right" aria-hidden="true"></i> Starworks Warehouse<br>
                                        <i class="fa fa-caret-right" aria-hidden="true"></i> Wolverhampton<br>
                                        <?php getInfos(); ?>
                                    </p>
                                </address>
                            </div>
                            <div class="col-sm-8">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2424.481885244926!2d-2.1305755847118024!3d52.57898033960983!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48709b979019b189%3A0xed450e43e8449ff4!2sStarworks+Warehouse+Wolverhampton!5e0!3m2!1sit!2sit!4v1507023626579" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen=""></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- BOTTOM LEFT -->
            <section id="about" data-top="100" data-bottom="-100" data-left="-100" data-right="100">
                <div class="plateWrapper">
                    <h3>About us</h3>
                </div>
                <div class="content">
                    <div class="container">
                        <p id="line" class="lead">About us</p>
                        <div class="row">
                            <div class="col-sm-6">
                                <img src="Images/main-room.jpg" class="img-fluid rounded">
                            </div>
                            <div class="col-sm-6">
                                <p id="desc">
                                    Starworks Warehouse is a 40,000 sq ft historic building now developed into an unrivaled events space, based in the Midlands.
                                    A cultural hub, hosting large scale music events, fashion shows, film screenings, art & design exhibitions, wedding fairs and pop up street food festivals…
                                    New Industrial music venue with world-class facilities including:<br><br>
                                    - 270,000 Watt sound system<br>
                                    - 2400 capacity main room<br>
                                    - Artist Dressing rooms with en suite facilities<br>
                                    - Artist Green Room with complimentary bar<br>
                                    - Two Production offices<br>
                                    - Tour bus parking
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- BOTTOM RIGHT -->
            <section id="history" data-top="100" data-bottom="-100" data-left="100" data-right="-100">
                <div class="plateWrapper">
                    <h3>History</h3>
                </div>
                <div class="content">
                    <div class="container">
                        <p id="line" class="lead">History</p>
                        <div class="row">
                            <div class="col-sm-6">
                                <p id="desc">
                                    The story began when Edward Lisle built his own first bicycle in the early 1870’s.
                                    After gaining mass success through racing his creation, he then began to build his bicycles to order.<br>
                                    Edward Lisle founded the Star Cycle Company In 1883. In 1889, business was booming and the company were able to purchase a factory on Stewart Street.
                                    By 1899, production levels reached an incredible 10,000 cycles per year, and by 1904 Star were the largest bicycle manufacturer in Wolverhampton.<br>
                                    However by 1897, times were changing. As were the demands of the customers.
                                    The company followed suit and acquired a ‘Benz Car’, using it as a template and basis for the design of their very own car.<br>
                                    The Star Cycle Company went on to purchase the rights to produce Star-Benz cars in Wolverhampton and began production at the Stewart Street Works.
                                    The cars were now being sold under the Star Motor Company name, a registered subsidiary of Star Engineering Limited, who adopted a policy of building as much as possible in house.<br>
                                    In 1902, the Star Motor Company finally changed its name to the Star Engineering Company.
                                    The business grew rapidly and diversified, expanding the Stewart Street works and obtaining additional premises in neighboring streets.<br>
                                    The company went on to undertake their final quest in 1903 – building a magnificent 40,000 sq. ft. site on Frederick Street, where it remains to this very day.
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <img src="Images/wall.jpg" class="img-fluid rounded">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- GALLERY MODAL -->
        <div class="modal fade" id="album-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div id="album" class="modal-dialog">
                <div id="content" class="modal-content">
                    <div class="modal-header header-gallery">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x fa-arrow-left" aria-hidden="true"></i></button>
                        <h4 class="modal-title" id="myModalLabel"></h4>
                    </div>
                    <div class="modal-body"></div>
                </div>
            </div>
        </div>
        
        <?php include_once 'Include/footer.html'; ?>
    </body>
    
    <!--Script-->
    <script src="Javascript/jquery.min.js"></script>
    <?php
        if ($detect->isMobile()) {}
        else {
            echo "<script src='Javascript/pace.min.js'></script>";
        }
    ?>
    <script src="Javascript/popper.min.js"></script>
    <script src="Javascript/bootstrap.min.js"></script>
    <script src="Javascript/zoom.min.js"></script>
    <script src="Javascript/vivus.min.js"></script>
    <script src="Javascript/init.js" type="text/javascript"></script>
</html>