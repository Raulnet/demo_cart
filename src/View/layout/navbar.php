<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">DEMO CART</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="<?php if($page == "home"): ?>active<?php endif; ?>"><a href="/">Home <span class="sr-only">(current)</span></a></li>
                <li class="<?php if($page == "command"): ?>active<?php endif; ?>"><a href="/command">Commandes</a></li>
            </ul>
        </div>
    </div>
</nav>