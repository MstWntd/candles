<?php include("header.php");?>
<!-- start gallery HTML containers -->
<div class="navigation-container">
	<div id="thumbs" class="navigation">
		<a class="pageLink prev" style="visibility: hidden;" href="#" title="Previous Page"></a>
		<ul class="thumbs noscript">
			<?php
				foreach ($images as $image){
					$prfx = '<a class="thumb" href="/images/candles/'.$image.'"><img src="/images/candles/'.$image.'" alt="one" /></a>';
					print '<li>'.$prfx;
					//print '<div class="caption"><div class="image-title portfolio_two">&quot;Pier by the sea, Fowey, Cornwall, UK&quot;</div></div>'
					print '</li>';
				}
			?>
		</ul>
		<a class="pageLink next" style="visibility: hidden;" href="#" title="Next Page"></a>
	</div>
</div>
<div class="content">
	<div class="slideshow-container">
		<div id="loading" class="loader"></div>
		<div id="slideshow" class="slideshow"></div>
		<div id="controls" class="controls portfolio_two"></div>
		<div id="caption" class="caption-container"></div>
	</div>
</div>
<!-- javascript at the bottom for fast page loading -->
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/jquery.easing-sooper.js"></script>
<script type="text/javascript" src="/js/jquery.sooperfish.js"></script>
<!-- initialise sooperfish menu -->
<script type="text/javascript">
	$(document).ready(function() {
	$('ul.sf-menu').sooperfish();
	});
</script>
<script type="text/javascript" src="/js/jquery.galleriffic.js"></script>
<script type="text/javascript" src="/js/jquery.opacityrollover.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		// we only want these styles applied when javascript is enabled
		$('div.content').css('display', 'block');
		// initially set opacity on thumbs and add additional styling for hover effect on thumbs
		var onMouseOutOpacity = 0.67;
		$('#thumbs ul.thumbs li, div.navigation a.pageLink').opacityrollover({
			mouseOutOpacity:   onMouseOutOpacity,
			mouseOverOpacity:  1.0,
			fadeSpeed:         'fast',
			exemptionSelector: '.selected'
		});
		// initialize advanced galleriffic gallery
		var gallery = $('#thumbs').galleriffic({
			delay:                     3500,
			numThumbs:                 10,
			preloadAhead:              10,
			enableTopPager:            false,
			enableBottomPager:         false,
			imageContainerSel:         '#slideshow',
			controlsContainerSel:      '#controls',
			captionContainerSel:       '#caption',
			loadingContainerSel:       '#loading',
			renderSSControls:          true,
			renderNavControls:         true,
			playLinkText:              'Play Slideshow',
			pauseLinkText:             'Pause Slideshow',
			prevLinkText:              '&lsaquo; Previous Photo',
			nextLinkText:              'Next Photo &rsaquo;',
			nextPageLinkText:          'Next &rsaquo;',
			prevPageLinkText:          '&lsaquo; Prev',
			enableHistory:             true,
			autoStart:                 false,
			syncTransitions:           true,
			defaultTransitionDuration: 900,
			onSlideChange:             function(prevIndex, nextIndex) {
				// 'this' refers to the gallery, which is an extension of $('#thumbs')
				this.find('ul.thumbs').children()
				.eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
				.eq(nextIndex).fadeTo('fast', 1.0);
				
				// update the photo index display
				this.$captionContainer.find('div.photo-index')
				.html('Photo '+ (nextIndex+1) +' of '+ this.data.length);
			},
			onPageTransitionOut:       function(callback) {
				this.fadeTo('fast', 0.0, callback);
			},
			onPageTransitionIn:        function() {
				var prevPageLink = this.find('a.prev').css('visibility', 'hidden');
				var nextPageLink = this.find('a.next').css('visibility', 'hidden');
				// show appropriate next / prev page links
				if (this.displayedPage > 0)
				prevPageLink.css('visibility', 'visible');
				var lastPage = this.getNumPages() - 1;
				if (this.displayedPage < lastPage)
				nextPageLink.css('visibility', 'visible');
				this.fadeTo('fast', 1.0);
			}
		});
		// event handlers for custom next / prev page links
		gallery.find('a.prev').click(function(e) {
			gallery.previousPage();
			e.preventDefault();
		});
		gallery.find('a.next').click(function(e) {
			gallery.nextPage();
			e.preventDefault();
		});
	});
</script>
<?php include("footer.php");?>