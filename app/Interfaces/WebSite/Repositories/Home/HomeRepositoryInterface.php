<?php 

namespace App\Interfaces\WebSite\Repositories\Home;

interface HomeRepositoryInterface{
    public function getSettings();
    public function getDaysOffs();
    public function getVacations();
}