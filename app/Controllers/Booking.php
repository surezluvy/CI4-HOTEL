<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\HotelModel;
use App\Models\BookingModel;

class Booking extends Controller
{
    public function add()
    {   
        $model = new BookingModel;
        $model2 = new HotelModel;
        $model3 = new UserModel;
        $data['book'] = $model->getBooking();
        $data['hotel'] = $model2->get();
        $data['user'] = $model3->get('user');

        echo view('admin/booking/add', $data);
    }

    public function addProcess()
    {
        $model = new BookingModel;
        $model2 = new HotelModel;
        $data['hotel'] = $model2->get($this->request->getPost('item_id'));

        $dateStart = strtotime($this->request->getPost('booking_date_start'));
        $dateEnd = strtotime($this->request->getPost('booking_date_end'));
        $dateCalculate = $dateEnd - $dateStart;

        $dateTotal = floor($dateCalculate/(60*60*24));
        if($dateTotal == 0){
            $dateTotal = 1;
        }
        $totalPrice = $dateTotal * $data['hotel'][0]['item_price'];

        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('admin/booking');
        }
        $upload = $this->request->getFile('booking_proof_of_payment');
        $upload->move(WRITEPATH . '../public/assets/images/proof');
        $data = array(
            'item_id' => $this->request->getPost('item_id'),
            'user_id'         => $this->request->getPost('user_id'),
            'booking_price'  => $totalPrice,
            'booking_date_start'         => $this->request->getPost('booking_date_start'),
            'booking_date_end'  => $this->request->getPost('booking_date_end'),
            'booking_proof_of_payment'  => $upload->getName(),
            'booking_status'  => 'pending',
        );
        $model->add($data);

        return redirect()->to('/admin/booking');
    }

    public function edit($id)
    {
        $model = new HotelModel;
        $get = $model->get($id)->getRow();
        if(isset($get)){
            $data['item'] = $get;
            echo view('admin/hotel/edit', $data);
        }else{
            echo '<script>
                    alert("ID '.$id.' Tidak ditemukan");
                    window.location="'.base_url('admin/hotel').'"
                </script>';
        }
    }

    public function editProcess()
    {
        $model = new HotelModel;
        $id = $this->request->getPost('id');
        $data = array(
            'item_name' => $this->request->getPost('item_name'),
            'item_type'         => $this->request->getPost('item_type'),
            'item_city'  => $this->request->getPost('item_city'),
            'item_address'         => $this->request->getPost('item_address'),
            'item_price'  => $this->request->getPost('item_price'),
            'item_desc'  => $this->request->getPost('item_desc'),
            'item_facility'  => $this->request->getPost('item_facility'),
        );
        $model->edit($data, $id);

        echo '<script>
            alert("Berhasil mengubah data");
            window.location="'.base_url('admin/hotel').'"
            </script>';
    }

    public function deleteData($id)
    {
        $model = new BookingModel;
        $get = $model->get($id)->getRow();
        if(isset($get))
        {
            $model->deleteData($id);
            echo '<script>
                    alert("Data berhasil di hapus");
                    window.location="'.base_url('admin/booking').'"
                </script>';
        }else{
            echo '<script>
                    alert("Hapus Gagal !, ID '.$id.' Tidak ditemukan");
                    window.location="'.base_url('admin/booking').'"
                </script>';
        }
    }

}