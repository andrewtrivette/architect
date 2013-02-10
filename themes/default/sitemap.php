<?
header("Content-Type: application/xml");
include('modules/configure.inc');
$content = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
echo $content;
foreach (glob("content/*.html") as $filename) {	
	echo '<url>'.PHP_EOL;
	echo '	<loc>'.BASE_URL.'page/'.basename($filename, '.html').'</loc>'.PHP_EOL;
	echo '	<lastmod>'.date ("Y-m-d", filemtime($filename)).'</lastmod>'.PHP_EOL;
	echo '	<changefreq>monthly</changefreq>'.PHP_EOL;
	echo '	<priority>1</priority>'.PHP_EOL;
	echo '</url>'.PHP_EOL;
}
foreach (glob("content/*", GLOB_ONLYDIR) as $filename) {
	$dir = basename($filename.'/');
	foreach (glob($filename."/*.html") as $filename1) {	
		echo '<url>'.PHP_EOL;
    	echo '	<loc>'.BASE_URL.'page/'.$dir.'/'.basename($filename1, '.html').'</loc>'.PHP_EOL;
    	echo '	<lastmod>'.date ("Y-m-d", filemtime($filename1)).'</lastmod>'.PHP_EOL;
      	echo '	<changefreq>monthly</changefreq>'.PHP_EOL;
      	echo '	<priority>1</priority>'.PHP_EOL;
   		echo '</url>'.PHP_EOL;
	}
}
echo '</urlset>';
?>