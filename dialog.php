<?php
require '../../../wp-admin/admin.php';

if (!is_admin())
	die("error");

$tags = ($_POST["tags"]) ? $_POST["tags"] : "山";

$url = sprintf("https://api.flickr.com/services/feeds/photos_public.gne?tags=%s", urlencode($tags));

$options = array(
	"http" => array(
		"method" => "GET",
		"header" => "User-Agent: wordpress-tinymce-flickr"
	)
);

$context = stream_context_create($options);

$feed = file_get_contents($url, false, $context);

$feed = simplexml_load_string($feed);
?>
<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	</head>
	<body id="hatebu">
		<div class="container-fluid" style="padding:15px;">
			<form class="form-inline" method="post" action="dialog.php">
				<div class="form-group">
					<input class="form-control" type="text" name="tags" value="<?php echo esc_html($tags); ?>" />				
				</div>
			</form>
			<?php foreach ($feed->entry as $entry): ?>
				<div class="well">
					<?php echo $entry->content;?>
					<div class="text-right"><button class="btn btn-primary" data-url="<?php echo $url; ?>" onClick="insert('<?php echo $entry->link['href'];?>')">挿入</button></div>
				</div>
			<?php endforeach; ?>
		</div>
		<script type="text/javascript">
            function insert(url) {
				top.tinymce.activeEditor.execCommand('mceInsertContent', false,  url);
            }
		</script>
	</body>
</html>
