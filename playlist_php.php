<?php
function loadPlaylists() {
$xml = simplexml_load_file("playlists.xml");
1.Build a music playlist manager using PHP and XML to organize and manage
return $xml->playlist; }
function savePlaylists($playlists) {
$xml = new SimpleXMLElement('<playlists/>');
foreach ($playlists as $playlist) {
$playlistNode = $xml->addChild('playlist', array('name' => $playlist->attributes()->name));
foreach ($playlist->song as $song) {
$songNode = $playlistNode->addChild('song');
$songNode->addChild('title', $song->title);
$songNode->addChild('artist', $song->artist); $songNode->addChild('path', $song->path);
} }
$xml->asXML("playlists.xml"); }
function addSongToPlaylist($playlistName, $songTitle, $artist, $filePath) {
$playlists = loadPlaylists();
foreach ($playlists as $playlist) {
if ($playlist->attributes()->name == $playlistName) {
$songNode = $playlist->addChild('song');
$songNode->addChild('title', $songTitle);
$songNode->addChild('artist', $artist);
$songNode->addChild('path', $filePath); savePlaylists($playlists);
break; } } }
$playlists = loadPlaylists();
actions (create playlist, add song, reorder - not implemented here, play, shuffle)
if (isset($_POST['playlist']) && isset($_POST['title']) && isset($_POST['artist']) &&
isset($_POST['path'])) {
$playlistName = $_POST['playlist'];
$songTitle = $_POST['title'];
$artist = $_POST['artist'];
$filePath = $_POST['path'];
addSongToPlaylist($playlistName, $songTitle, $artist, $filePath);
header("Location: index.php");
} ?>