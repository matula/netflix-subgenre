<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Netflix Sub-genre Generator">
    <meta name="author" content="Terry Matula">
    @if(!$new)
      <meta property="og:image" content="{{ $movies[0]->poster }}"/>
      <meta property="og:title" content="{{ $genre }}"/>
      <meta property="og:url" content="{{ url('genre/' . $code) }}"/>
      <meta property="og:site_name" content="Netflix Sub-genre Generator"/>
    @endif

    <title>Netflix Sub-genre Generator</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    @if(!$new)
      <div id="fb-root"></div>
      <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=1431239663758271";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>
    @endif
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Netflix<sup>&reg;</sup> Sub-genre Generator</a>
        </div>
        <div class="pull-right disclaimer">Not affiliated with Netflix<sup>&reg;</sup> in any way. This is just for fun.</div>
      </div>
    </div>

    <div class="container">

      <div class="headline">
        <p class="lead">
          <a href="http://netflix.com" target="_blank">Netflix</a> sometimes comes up with quite interesting sub-genres in the movie lists.<br>
          Here's a new suggestion!
        </p>
      </div>
      <div class="genre-box">
        <h3>{{ $genre }}</h3>
        <ul id="movie-list">
          <?php $movie_ids = array() ?>
        @foreach($movies as $movie)
          <?php $movie_ids[] = $movie->id ?>
          <li>
            <a href="{{ $movie->link }}" target="_blank">
              <div class="overlay"></div>
              <img src="{{ $movie->poster }}" title="{{ $movie->title }}">
            </a>
          </li>
        @endforeach
        </ul>
      </div>
      <div class="clearfix"></div>
      <div class="save">
        @if($new)
          {{ Form::open(array('url' => 'save')) }}
            {{ Form::hidden('genre', $genre) }}
            {{ Form::hidden('movies', json_encode($movie_ids)) }}
            {{ Form::submit('Save and Share', array('class' => 'btn btn-primary')) }}
          {{ Form::close() }}
        @else
        <h4>Share!</h4>
          <div class="fb-share-button" data-type="button_count"></div>
          <div class="tw-button">
            <a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
          </div>
          <div class="gp-button">
          <!-- Place this tag where you want the share button to render. -->
          <div class="g-plus" data-action="share" data-annotation="bubble"></div>
          </div>
          <!-- Place this tag after the last share tag. -->
          <script type="text/javascript">
            (function() {
              var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
              po.src = 'https://apis.google.com/js/plusone.js';
              var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
            })();
          </script>
          
          <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        @endif
      </div>
    </div>
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
  </body>
</html>
