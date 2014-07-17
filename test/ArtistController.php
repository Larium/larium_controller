<?php

use Larium\Controller\ActionController;

use Larium\Http\Request;
use Larium\Http\Response;

class ArtistController extends ActionController
{
    protected $id;

    protected $variable;

    public function init($request)
    {
        $this->variable = 2;
    }

    public function show($id, Request $request)
    {
        $this->id = $id;

        return new Response($this->variable);
    }
}
