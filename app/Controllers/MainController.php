<?php

namespace App\Controllers;

use App\Models\MainModel;

class MainController extends BaseController
{
    public function create()
    {
        $name = $this->request->getPost('name');

        // Insert a new playlist into the 'playlists' table
        $playlistData = [
            'name' => $name,
        ];

        $playlistModel = new MainModel(); // Replace 'MainModel' with your actual model name
        $playlistId = $playlistModel->insert($playlistData);

        // Redirect to the playlist page
        return redirect()->to("/player/playlists/{$playlistId}");
    }

    public function playlists($id)
    {
        $playlistModel = new MainModel(); // Replace 'MainModel' with your actual model name

        $playlist = $playlistModel->find($id);

        if ($playlist) {
            // Retrieve tracks associated with the playlist
            $tracks = $playlistModel->getTracksByPlaylist($id); // Implement this method in your model

            $data = [
                'playlist' => $playlist,
                'tracks' => $tracks,
                'allPlaylists' => $playlistModel->findAll(),
            ];

            return view('player', $data);
        } else {
            return redirect()->to('/player');
        }
    }

    public function upload()
    {
        $file = $this->request->getFile('file');
        $title = $this->request->getPost('title');
        $artist = $this->request->getPost('artist');
    
        // Move the uploaded file to the public directory
        $newName = $title . '_' . $artist . '.mp3';
        $file->move(ROOTPATH . 'public/', $newName);
    
        // Insert the new music track into the 'music' table
        $musicData = [
            'title' => $title,
            'artist' => $artist,
            'file_path' => $newName,
        ];
    
        $musicModel = new MainModel(); // Replace 'MainModel' with your actual model name
        $musicModel->insert($musicData);
    
        return redirect()->to('/player');
    }
    


    public function player()
    {
        $mainModel = new MainModel(); // Replace 'MainModel' with your actual model name
        $data['music'] = $mainModel->findAll();
        $data['playlists'] = $mainModel->findAll(); // Correct method name here
        return view('main', $data);
    }
}
