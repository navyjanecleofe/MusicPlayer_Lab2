<?php
// Sample data for playlists (replace with your actual data)
$playlists = [
    ['id' => 1, 'name' => 'Playlist 1'],
    ['id' => 2, 'name' => 'Playlist 1'],
    // Add more playlists here
];

// Sample data for music (replace with your actual data)
$music = [
    ['id' => 1, 'title' => 'Song 1', 'artist' => 'Artist 1', 'file_path' => 'song1.mp3'],
    ['id' => 2, 'title' => 'Song 2', 'artist' => 'Artist 2', 'file_path' => 'song2.mp3'],
    // Add more songs here
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Player</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f5f5f5;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        #player-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        audio {
            width: 100%;
        }

        #playlist {
            list-style: none;
            padding: 0;
        }

        #playlist li {
            cursor: pointer;
            padding: 10px;
            background-color: #eee;
            margin: 5px 0;
            transition: background-color 0.2s ease-in-out;
        }

        #playlist li:hover {
            background-color: #ddd;
        }

        #playlist li.active {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>
<body>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <!-- Your modal content for playlists here -->
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Select Playlist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-unstyled mt-3">
                    <select name="playlist" class="form-control">
                        <option value="">Select Playlist</option>
                        <?php foreach ($playlists as $playlist): ?>
                            <option value="<?= $playlist['id'] ?>"><?= $playlist['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </ul>
            </div>
            <div class="modal-footer">
                <a href="#" data-bs-dismiss="modal">Close</a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#createPlaylist">Create New</a>
            </div>
        </div>
    </div>
</div>
<form action="/" method="get">
    <input type="search" name="search" placeholder="Search song">
    <button type="submit" class="btn btn-primary">Search</button>
</form>
<h1>Music Player</h1>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    My Playlist
</button>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadsong">
    Upload Song
</button>
<h1 id="currentTrackTitle"></h1>
<audio id="audio" controls autoplay type="audio/mpeg"></audio>
<ul class="list-unstyled mt-3" id="playlists">
    <?php foreach ($music as $mus): ?>
        <li class="align-items-center" data-src="<?= $mus['file_path'] ?>">
            <a href="#" id="music" class="play-link" data-music-id="<?= $mus['id'] ?>">
                <?= $mus['title'] ?> by <?= $mus['artist'] ?>
            </a>
            <button class="btn btn-primary add-to-playlist-btn" data-music-id="<?= $mus['id'] ?>" data-toggle="modal"
                    data-target="#myModal">
                Add to Playlist
            </button>
        </li>
    <?php endforeach; ?>
</ul>
<div class="modal fade" id="uploadsong" tabindex="-1" aria-labelledby="uploadSongsLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadSongLabel">Upload a Song</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('upload') ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="artist" class="form-label">Artist</label>
                        <input type="text" class="form-control" id="artist" name="artist" required>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">File</label>
                        <input type="file" class="form-control" id="file" name="file" accept=".mp3" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="myModal">
    <!-- Your modal content for adding songs to a playlist here -->
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Select Playlist</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="/" method="post">
                    <input type="hidden" id="musicID" name="musicID">
                    <select name="playlist" class="form-control">
                        <option value="playlist">Playlist</option>
                    </select>
                    <input type="submit" name="add">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript code for handling audio playback and modals
    $(document).ready(function () {
        // Get references to the button and modal
        const modal = $("#myModal");
        const musicID = $("#musicID");

        // Add click event listeners to all play-link elements
        $(".play-link").click(function () {
            const musicId = $(this).data("music-id");
            // Set the selected music ID in the hidden input field
            musicID.val(musicId);
            // Display the modal
            modal.modal("show");
        });

        // When the user clicks the close button or outside the modal, close it
        modal.on("hidden.bs.modal", function () {
            musicID.val(""); // Clear the selected music ID
        });
    });
</script>
<script>
    const audio = document.getElementById('audio');
    const playlistItems = document.querySelectorAll('#playlists li');

    let currentTrack = 0;

    function playTrack(trackIndex) {
        if (trackIndex >= 0 && trackIndex < playlistItems.length) {
            const track = playlistItems[trackIndex];
            const trackSrc = track.getAttribute('data-src');
            audio.src = trackSrc;
            audio.play();
            currentTrack = trackIndex;
        }
    }

    function nextTrack() {
        currentTrack = (currentTrack + 1) % playlistItems.length;
        playTrack(currentTrack);
    }

    function previousTrack() {
        currentTrack = (currentTrack - 1 + playlistItems.length) % playlistItems.length;
        playTrack(currentTrack);
    }

    playlistItems.forEach((item, index) => {
        item.addEventListener('click', () => {
            playTrack(index);
        });
    });

    audio.addEventListener('ended', () => {
        nextTrack();
    });

    playTrack(currentTrack);
</script>
</body>
</html>
