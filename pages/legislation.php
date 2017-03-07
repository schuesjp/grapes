<html lang="en">

    <head>

        <!-- META Data -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Anthony Zheng">
        <meta name="keywords" content="">

        <!-- Site Title (What shows up in the tab) -->
        <title>Grapevine | Legislation</title>

        <!-- Bootstrap & CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="../css/scrolling-nav.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/style.css">

    </head>

    <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand page-scroll" href="../index.html#page-top"><img src="../img/logo.png"></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                        <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                        <li class="hidden">
                            <a class="page-scroll" href="../index.html#page-top"></a>
                        </li>
                        <li>
                            <a class="page-scroll" href="../index.html#about">About</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="../index.html#contact">Contact</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#">Legislation</a>
                        </li>
                        <li>
                            <a class="login-btn" href="../index.html">
                                <span class="glyphicon glyphicon-home"></span> Home
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <!-- Legislation Search -->
        <section class="intro-section" id="legiSearch">
            <div class="container">
                <div class="row">
                    <div class="col-sm-offset-3 col-xs-4 text-right">
                        <input type="text" v-model="query" placeholder="Search Legislation">
                    </div>
                    <div class="col-xs-2 text-left">
                        <button>Search</button>
                    </div>
                </div>
                <div class="row text-left" v-for="result in searchResult">
                    <a :href="result.url"><h3> {{ result.title }} </h3></a>
                </div>
            </div>
        </section>

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <!-- Vue 2 Framework -->
        <script src="https://unpkg.com/vue@2.1.7/dist/vue.js"></script>

        <!-- Main Scripts -->
        <script src="../js/jquery.easing.min.js"></script>
        <script src="../js/scrolling-nav.js"></script>
        <script src="../js/legiSearch.js"></script>

    </body>

</html>
