<?php

use Larium\Controller\ActionController;

use Larium\Http\Request;
use Larium\Http\Response;

class ArtistController extends ActionController
{
    protected $id;

    public function show($id, Request $request)
    {
        $this->id = $id;
    }
}
