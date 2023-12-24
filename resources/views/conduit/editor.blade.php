<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8" />
  <title>Conduit</title>
  <!-- Import Ionicon icons & Google Fonts our Bootstrap theme relies on -->
  <link href="//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <link
    href="//fonts.googleapis.com/css?family=Titillium+Web:700|Source+Serif+Pro:400,700|Merriweather+Sans:400,700|Source+Sans+Pro:400,300,600,700,300italic,400italic,600italic,700italic"
    rel="stylesheet" type="text/css" />
  <!-- Import the custom Bootstrap 4 theme from our hosted CDN -->
  <link rel="stylesheet" href="//demo.productionready.io/main.css" />
</head>

<!-- header -->
<nav class="navbar navbar-light">
  <div class="container">
    <a class="navbar-brand" href="{{ route('conduit.index') }}">conduit</a>
    <ul class="nav navbar-nav pull-xs-right">
      <li class="nav-item">
        <!-- Add "active" class when you're on that page" -->
        <a class="nav-link active" href="{{ route('conduit.index') }}">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('conduit.editorNew') }}"> <i class="ion-compose"></i>&nbsp;New Article </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/settings"> <i class="ion-gear-a"></i>&nbsp;Settings </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/profile/eric-simons">
          <img src="" class="user-pic" />
          Eric Simons
        </a>
      </li>
    </ul>
  </div>
</nav>

<!-- main -->
<div class="editor-page">
  <div class="container page">
    <div class="row">
      <div class="col-md-10 offset-md-1 col-xs-12">
        <ul class="error-messages">
          <!-- <li>That title is required</li> -->
        </ul>

        <form method="post" action="{{ route('conduit.store') }}">
          @csrf
          <fieldset>
            <fieldset class="form-group">
              <input type="text" name="title" id="title" class="form-control form-control-lg"
                placeholder="Article Title" />
            </fieldset>
            <fieldset class="form-group">
              <input type="text" name="description" id="description" class="form-control"
                placeholder="What's this article about?" />
            </fieldset>
            <fieldset class="form-group">
              <textarea name="body" id="body" class="form-control" rows="16"
                placeholder="Write your article (in markdown)"></textarea>
            </fieldset>
            <!-- <fieldset class="form-group">
              <input type="text" class="form-control" placeholder="Enter tags" />
              <div class="tag-list">
                <span class="tag-default tag-pill"> <i class="ion-close-round"></i> tag </span>
              </div>
            </fieldset> -->
            <button class="btn btn-lg pull-xs-right btn-primary" type="button">
              Publish Article
            </button>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- footer -->
<footer>
  <div class="container">
    <a href="{{ route('conduit.index') }}" class="logo-font">conduit</a>
    <span class="attribution">
      An interactive learning project from <a href="https://thinkster.io">Thinkster</a>. Code &amp;
      design licensed under MIT.
    </span>
  </div>
</footer>

</html>