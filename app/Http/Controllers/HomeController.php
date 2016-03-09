<?php

namespace App\Http\Controllers;

use App\Domain\Services\ImageService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService) {
        $this->imageService = $imageService;
    }

    public function index() {
        return view('welcome' , [
            'images' => $this->imageService->getImages(1),
        ]);
    }
}
