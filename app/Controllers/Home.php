<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\HotelModel;
use App\Models\BookingModel;
use App\Models\ImageModel;

class Home extends Controller
{
    public function index()
    {
        $model = new UserModel;
        $data['user'] = $model->get('user');
        echo view('home/index', $data);
    }

    public function admin()
    {
        $model = new UserModel;
        $data['user'] = $model->get('admin');
        echo view('admin/admin/index', $data);
    }

    public function hotel()
    {
        $model = new HotelModel;
        $data['item'] = $model->get();
        echo view('admin/hotel/index', $data);
    }

    public function image($id)
    {
        $model = new ImageModel;
        $data['image'] = $model->get($id);
        $data['id'] = $id;
        
        echo view('admin/image/index', $data);
    }

    public function booking()
    {
        $model = new BookingModel;
        $data['book'] = $model->get();
        echo view('admin/booking/index', $data);
    }

}