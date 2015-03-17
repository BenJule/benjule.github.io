$classFile= __DIR__ . '/../inc/ClassBitleaderFirewallStatistics.php';
if (file_exists($classFile) && is_readable($classFile)) {
    $classFile = realpath($classFile);
} else {
    die($classFile . ' doesn\'t exist.');
}

try {
    require_once($classFile);
    $bfs = new BitleaderFirewallStatistics();
} catch (Exception $e) {
    die('Error loading the core class file. The error was: ' . $e->getMessage());
}

$files = $bfs->getFiles();

?><!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Start Bootstrap's collection of free Bootstrap portfolio themes and templates. Our portfolio themes are perfect for web designers, agencies, artists, and more!">
<meta name="author" content="Start Bootstrap">

<title>
  
    Free Bootstrap Portfolio Themes &amp; Templates - Start Bootstrap
  
</title>

<!-- Google+ Authorship Information -->
<link rel="author" href="https://plus.google.com/+Startbootstrap">
<link rel="publisher" href="https://plus.google.com/+Startbootstrap">

<!-- Canonical -->
<link rel="canonical" href="http://startbootstrap.com/template-categories/portfolios/">

<!-- Fav Icon and Apple Touch Icons -->
<link rel="icon" href="/assets/img/ico/favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon" href="/assets/img/ico/touch-icon-iphone.png">
<link rel="apple-touch-icon" sizes="76x76" href="/assets/img/ico/touch-icon-ipad.png">
<link rel="apple-touch-icon" sizes="120x120" href="/assets/img/ico/touch-icon-iphone-retina.png">
<link rel="apple-touch-icon" sizes="152x152" href="/assets/img/ico/touch-icon-ipad-retina.png">

<!-- Open Graph -->
<meta property="og:title" content="Free Bootstrap Portfolio Themes &amp; Templates">
<meta property="og:site_name" content="Start Bootstrap">
<meta property="og:type" content="website">
<meta property="og:description" content="Start Bootstrap's collection of free Bootstrap portfolio themes and templates. Our portfolio themes are perfect for web designers, agencies, artists, and more!">
<meta property="og:image" content="http://startbootstrap.com/assets/img/og/startbootstrap-logo.jpg">
<meta property="og:url" content="http://startbootstrap.com/template-categories/portfolios/">

<!-- Fonts -->
<link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400italic,700italic,400,700" rel="stylesheet" type="text/css">
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<!-- Bootstrap Core CSS -->
<link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">

<!-- Bootstrap Table CSS -->
<link href="/assets/css/bootstrap-table.min.css" rel="stylesheet" type="text/css">


<!-- Start Bootstrap Custom CSS -->
<link href="/assets/css/startbootstrap.css" rel="stylesheet" type="text/css">

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Start Bootstrap</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Our Collection of Templates &amp; Themes">Project <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="/template-categories/all"><i class="fa fa-globe fa-fw"></i> All Projects</a>
                        </li>
                        <li>
                            <a href="/template-categories/popular"><i class="fa fa-star fa-fw"></i> Most Popular</a>
                        </li>
                        <li class="divider"></li>
                        <li class="dropdown-header">
                            Projects &amp; Site Categories:
                        </li>
                        <li>
                            <a href="/template-categories/admin-dashboard">Network Status</a>
                        </li>
                        <li>
                            <a href="/project-categories/bfs-ff3l-firewall">BFS-FF3L Firewall Status</a>
                        </li>
                        <li>
                            <a href="/project-categories/bootstrap-table">Bootstrap Tables</a>
                        </li>
                        <li>
                            <a href="/project-categories/highcharts">Highcharts</a>
                        </li>
                   </ul>
                </li>
                <li>
                    <a href="#" title="The Official Start Bootstrap Blog">Blog</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Bootstrap Related Resources">Resources <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="/bootstrap-resources"><i class="fa fa-list fa-fw"></i> Bootstrap Resources List</a>
                        </li>
                        <li>
                            <a href="/showcase"><i class="fa fa-desktop fa-fw"></i> Start Bootstrap Showcase</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="/help" title="Help with Start Bootstrap Templates &amp; Themes">Help</a>
                </li>
                <li>
                    <a href="/contact" title="Contact the Start Bootstrap Team">Contact</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Öogin Pannel"><i class="fa fa-star text-yellow"></i> Login <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="/bootstrap-design-services"><i class="fa fa-fw fa-paint-brush"></i> Custom Bootstrap Design Services</a>
                        </li>
                        <li>
                            <a href="https://wrapbootstrap.com/?ref=StartBootstrap"><i class="fa fa-fw fa-shopping-cart"></i> WrapBootstrap - Premium Bootstrap Themes</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>


<header class="sb-page-header">
    <div class="container">
        <h1>BitLeader FF3L Firewall</h1>
        <p>Handle your Network with BitLeader Firewall Script.</p>
        <div id="carbonads-container">
    <div class="carbonad">
        <div id="azcarbon"></div>
        <script type="text/javascript">
        var z = document.createElement("script");
        z.type = "text/javascript";
        z.async = true;
        z.src = "http://engine.carbonads.com/z/51625/azcarbon_2_1_0_HORIZ";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(z, s);
        </script>
    </div>
</div>

    </div>
</header>

<!-- Page Content -->

        <div class="container-fluid col-group">
            <div class="col-lg-6">
                <div
                    class="panel panel-info load-highchart"
                    id="highchart-total-throughput"
                    data-source="json"
                    data-ytitle=""
                    data-type="line"
                    data-stacking="percentage"
                    data-legend="enabled"
                    data-tooltip-convert="B"
                    data-url="type=throughput"
                >
                    <div class="panel-heading">
                        <h4 class="panel-title">Total Throughput (iptables)
                            <small>(stacked / stats for <?php echo $bfs->config['pubif'];?>)</small>
                        </h4>
                    </div>
                    <div class="panel-body"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div
                    class="panel panel-info load-highchart"
                    id="collectd-if-<?php echo $bfs->config['pubif'];?>"
                    data-source="json"
                    data-ytitle=""
                    data-url="type=collectd&folder=interface-<?php echo $bfs->config['pubif'];?>&metric=if_octets"
                    data-legend="disabled"
                    data-tooltip-convert="B"
                >
                    <div class="panel-heading">
                    <h4 class="panel-title">Total Throughput (collectd) <small>(stats for <?php echo $bfs->config['pubif'];?>)</small></h4>
                    </div>
                    <div class="panel-body"></div>
                </div>
            </div>
        </div>
        <div class="container-fluid col-group">
            <div class="col-lg-6">
                <div
                    class="panel panel-default load-highchart"
                    id="collectd-load"
                    data-source="json"
                    data-ytitle=""
                    data-url="type=collectd&folder=cpu-0"
                    data-legend="disabled"
                    data-stacking="percentage"
                    data-max-y=100
                >
                    <div class="panel-heading">
                    <h4 class="panel-title">CPU Average (collectd) <small>(stacked / stats for CPU0)</small></h4>
                    </div>
                    <div class="panel-body"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div
                    class="panel panel-default load-highchart"
                    id="collectd-load"
                    data-source="json"
                    data-ytitle=""
                    data-url="type=collectd&folder=cpu-1"
                    data-legend="disabled"
                    data-stacking="percentage"
                    data-max-y=100
                >
                    <div class="panel-heading">
                    <h4 class="panel-title">CPU Average (collectd) <small>(stacked / stats for CPU1)</small></h4>
                    </div>
                    <div class="panel-body"></div>
                </div>
            </div>
        </div>
        <div class="container-fluid col-group">
            <div class="col-lg-12">
                <div
                    class="panel panel-default load-highchart"
                    id="collectd-memory"
                    data-source="json"
                    data-ytitle=""
                    data-url="type=collectd&folder=memory"
                    data-legend="enabled"
                    data-stacking="percentage"
                    data-type="areaspline"
                    data-tooltip-convert="B"
                >
                    <div class="panel-heading">
                    <h4 class="panel-title">Memory <small>(stacked)</small></h4>
                    </div>
                    <div class="panel-body"></div>
                </div>
            </div>
        </div>
        <div class="container-fluid col-group">
            <div class="col-lg-6">
                <div
                    class="panel panel-default load-highchart"
                    id="highcharts-total-bytes"
                    data-source="json"
                    data-ytitle=""
                    data-alias="total"
                    data-type="areaspline"
                    data-stacking="percentage"
                    data-tooltip-convert="B"
                    data-url="type=bytes&start=<?php echo time()-(3*60*60);?>"
                >
                    <div class="panel-heading">
                        <h4 class="panel-title">Total Bytes (iptables)
                            <small>(stacked / stats for <?php echo $bfs->config['pubif'];?>)</small>
                        </h4>
                    </div>
                    <div class="panel-body"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div
                    class="panel panel-default load-highchart"
                    id="highcharts-total-packets"
                    data-source="json"
                    data-ytitle=""
                    data-colors="#000000|#F28F43|#FE123A|#910000|#0f667a|#8bbc21"
                    data-type="spline"
                    data-url="type=packets&start=<?php echo time()-(3*60*60);?>"
                >
                    <div class="panel-heading">
                        <h4 class="panel-title">Total Packets (iptables)
                            <small>(statistics for <?php echo $bfs->config['pubif'];?>)</small>
                        </h4>
                    </div>
                    <div class="panel-body"></div>
                </div>
            </div>
        </div>
        <div class="container-fluid col-group">
            <div class="col-lg-6">
                <div
                    class="panel panel-default load-highchart"
                    id="highchart-collectd-df-root"
                    data-source="json"
                    data-ytitle=""
                    data-type="areaspline"
                    data-stacking="percentage"
                    data-legend="enabled"
                    data-tooltip-convert="B"
                    data-url="type=collectd&folder=df-root"
                >
                    <div class="panel-heading">
                        <h4 class="panel-title">Disk Stats / (collectd)
                            <small>(stacked)</small>
                        </h4>
                    </div>
                    <div class="panel-body"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div
                    class="panel panel-default load-highchart"
                    id="highchart-collectd-disk-vda"
                    data-source="json"
                    data-ytitle=""
                    data-legend="disabled"
                    data-url="type=collectd&folder=disk-vda&metric=disk_ops"
                    data-type="line"
                >
                    <div class="panel-heading">
                    <h4 class="panel-title">Disk IOPS (collectd) <small>(stats for /dev/vda)</small></h4>
                    </div>
                    <div class="panel-body"></div>
                </div>
            </div>
        </div>

<!-- Footer -->
<div class="cta-mail">
    <div class="container text-center">
        <h2>Want more Bootstrap themes &amp; templates?</h2>
        <h4>Subscribe to our mailing list to receive an update when new items arrive!</h4>
        <div id="mc_embed_signup">
            <form role="form" action="#" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank" novalidate>
                <div class="input-group input-group-lg">
                    <input type="email" name="EMAIL" class="form-control" id="mce-EMAIL" placeholder="Email address...">
                    <span class="input-group-btn">
                        <button type="submit" name="subscribe" id="mc-embedded-subscribe" class="btn btn-default">Subscribe!</button>
                    </span>
                </div>
                <div id="mce-responses">
                    <div class="response" id="mce-error-response" style="display:none"></div>
                    <div class="response" id="mce-success-response" style="display:none"></div>
                </div>
            </form>
        </div>
        <!-- End MailChimp Signup Form -->
    </div>
</div>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-6 footer-left">
                <ul class="list-inline">
                    <li>
                        <a href="/">Home</a>
                    </li>
                    <li>
                        <a href="/all-templates">Themes</a>
                    </li>
                    <li>
                        <a href="http://startbootstrap.tumblr.com/">Blog</a>
                    </li>
                    <li>
                        <a href="/bootstrap-resources">Resources</a>
                    </li>
                    <li>
                        <a href="/help">Help</a>
                    </li>
                    <li>
                        <a href="/contact">Contact</a>
                    </li>
                </ul>
                <p>
                    <iframe id="gh-fork" src="http://ghbtns.com/github-btn.html?user=benjule&repo=benjule.github.io&type=fork" allowtransparency="true" frameborder="0" scrolling="0" width="55px" height="20px"></iframe>
                    <iframe id="gh-star" src="http://ghbtns.com/github-btn.html?user=benjule&repo=benjule.github.io&type=watch&count=true" allowtransparency="true" frameborder="0" scrolling="0" width="110px" height="20px"></iframe>
                    <a href="https://twitter.com/SBootstrap" class="twitter-follow-button" data-show-count="false" data-lang="en">Follow @SBootstrap</a>
                    <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://startbootstrap.com" data-via="SBootstrap" data-lang="en">Tweet</a>
                    <br>
                    <span class="g-follow" data-annotation="bubble" data-height="20" data-href="//plus.google.com/116841216196186745329" data-rel="publisher"></span>
                    <span class="g-plusone" data-size="medium" data-href="http://startbootstrap.com/"></span>
                    <br>
                    <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FIronSummitMedia&amp;width=450&amp;height=21&amp;colorscheme=light&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;send=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:150px; height:21px;" allowTransparency="true"></iframe>
                </p>
            </div>
            <div class="col-md-6 footer-right">
                <p><a href="http://benjule.github.io">Start Bootstrap</a> is a project maintained by <a href="http://benjule.github.io">BenLue.</a>.</p>
                <p>Bootstrap CDN by <a href="http://tracking.maxcdn.com/c/99191/3982/378"><img src="/assets/img/maxcdn-logo.png" alt="MaxCDN Logo"></a></p>
                <p>Hosted on <a href="https://pages.github.com/"><img src="/assets/img/gh-pages-logo.png" alt="GitHub Pages Logo"></a></p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-12 footer-below">
                <p>Themes and templates licensed under the <a href="http://www.apache.org/licenses/LICENSE-2.0">Apache License v2.0</a>.
                <br>Based on <a href="http://getbootstrap.com/">Bootstrap</a>.</p>
            </div>
        </div>
    </div>
</footer>


<!-- JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="./assets/js/docs.js"></script>
<script src="./assets/js/startbootstrap.js"></script>
<script src="./assets/js/bootstrap-table.min.js"></script>
<script src="./assets/js/bootstrap-table-editable.js"></script>
<script src="./assets/js/bootstrap-editable.js"></script>
<script src="./assets/js/bootstrap-table-export.js"></script>
<script src="./assets/js/tableExport.js"></script>
<script src="./assets/js/jquery.base64.js"></script>
<script src="./assets/js/bootstrap-table-flatJSON.min.js"></script>
<script type="text/javascript" src="//code.highcharts.com/highcharts.js"></script>
<script type="text/javascript" src="/../bfs.js"></script>


</body>

</html>