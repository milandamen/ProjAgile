<?php
namespace App\Repository;
use App\Repository\BaseRepository;
use App\Models\Newscomment;

class NewscommentRepository extends BaseRepository
{
    public function getAll() {
        return Newscomment::all();
    }

    public function get($id) {
        return Newscomment::find($id);
    }

    public function create($attributes = array()) {
        return Newscomment::create($attributes);
    }

}
?>
