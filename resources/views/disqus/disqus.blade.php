<div id="disqus_thread"></div>
<script>
var disqus_config = function () {
this.page.url = "https://ruiming.me/post/{{ $post->id }}"; // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = "{{$post->id}}"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');

s.src = 'https://ruiming.disqus.com/embed.js';

s.setAttribute('data-timestamp', + new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>