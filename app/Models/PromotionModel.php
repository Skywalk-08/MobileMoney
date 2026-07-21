<?php 

namespace App\Models;

use CodeIgniter\Model;

class PromotionModel extends Model{
     protected $table            = 'promotion';
    protected $primaryKey       = 'id';
    protected $useTimestamps    = false;
    protected $allowedFields    = ['pourcentage'];

    public function getPourcentage(int $id) : float {
        $pourcentage = $this->select('pourcentage')
                            ->where('id', $id);

        return (float) $pourcentage;
    }
}