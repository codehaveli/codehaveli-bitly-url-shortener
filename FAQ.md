# Codehaveli Bitly URL Shortener

## Frequently Asked Questions

### How to get the short link of a post?

```
$link = get_wbitly_short_url($post_id); // link or false

```

### How to generate shortlink of a link?

```
$short_link = wbitly_generate_shorten_url($long_link); // link or false
```

### How can i change the URL before the shorten process?

```
add_filter('wbitly_url_before_process' , 'modify_permalink_of_post' , 10 , 1);
function modify_permalink_of_post($permalink){
	return $permalink;
}

```

You can use `wbitly_url_before_process` filter to change the URL/Permalink. Call back function accepts the permalink.

### How can i hook into the generated URL?

```
add_action('wbitly_shorturl_updated' , 'post_to_other' , 10 , 1);
function post_to_other($url){
 // do anything with $url
}
```

We can use the hook to do get the short url and use it accordingly
