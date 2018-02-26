<nav class="navbar navbar-default index_nav" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand nav_title" href="{{ route('MainHome') }}">經濟未來學</a>
        </div>
        <div class="collapse navbar-collapse nav_ul_baseSet" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ route('MainHome') }}">首頁</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">分頁 <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('MainHome') }}">課程分析</a></li>
                        <li><a href="{{ route('KnowledgeAnalysis') }}">知識點分析</a></li>
                        <li><a href="{{ route('BaseQualitiesAnalysis') }}">基本素養分析</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
