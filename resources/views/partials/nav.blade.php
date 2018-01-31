<nav class="navbar navbar-default index_nav" role="navigation">
    <!--"navbar-default" 設置背景顏色 而role="navigation"是讓瀏覽器知道此為導航覽-->
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <!--為Html5 新增的自訂義屬性"data" 可用jquery的data()涵式來操作裡面的值-->
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand nav_title" href="index.html">經濟未來學</a>
        </div>
        <div class="collapse navbar-collapse nav_ul_baseSet" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="index.html">首頁</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">分頁 <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="index.html">課程分析</a></li>
                        <li><a href="page2.html">知識點分析</a></li>
                        <li><a href="page3.html">基本素養分析</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
