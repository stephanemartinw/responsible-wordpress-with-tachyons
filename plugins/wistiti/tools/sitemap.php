<?php
/**
 * from https://github.com/rohitgilbile7/sitemap
 * start page for webaccess
 * redirect the user to the supported page type by the users webbrowser (js available or not)
 *
 * @category  PHP
 * @package   rohitgilbile
 * @author    Rohit Gilbile <rohitgilbile7@gmail.com>
 * @link      http://phplesson.com

 ***************************************************
* XML Sitemap in Wistiti
*****************************************************/

function xml_sitemap() {
  $postsForSitemap = get_posts(array(
    'numberposts' => -1,
    'orderby' => 'modified',
    'post_type'  => array('post','page'),
    'order'    => 'DESC'
  ));

  $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
  $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

  foreach($postsForSitemap as $post) {
    setup_postdata($post);

    $postdate = explode(" ", $post->post_modified);

    $sitemap .= '<url>'.
      '<loc>'. get_permalink($post->ID) .'</loc>'.
      '<lastmod>'. $postdate[0] .'</lastmod>'.
      '<changefreq>monthly</changefreq>'.
    '</url>';
  }

  $sitemap .= '</urlset>';

  $fp = fopen(ABSPATH . "sitemap.xml", 'w');
  fwrite($fp, $sitemap);
  fclose($fp);
}

add_action("save_post", "xml_sitemap");
//add_action("publish_post", "xml_sitemap");
//add_action("publish_page", "xml_sitemap");
?>
