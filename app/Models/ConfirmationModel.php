<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class ConfirmationModel extends Model
{
    protected $table = 'booking';
    protected $primaryKey = 'booking_id';
     
    public function getConfirmation($id = false)
    {
        if($id === false){
            return $this->db->table('confirmation')
                            ->join('admin', 'confirmation.admin_id=admin.admin_id')
                            ->join('booking', 'confirmation.booking_id=booking.booking_id')
                            ->get()->getResultArray();
            return $this->findAll();
        }else{
            return $this->db->table('item')->join('item_image', 'item.image_id=item_image.image_id')->getWhere(['item.item_id' => $id])->getResultArray();
        }   
    }
}