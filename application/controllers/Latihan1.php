<?php
class latihan1 extends CI_Controller
{
    public function index()
    {
        echo "selamat datang lur.... selamat belajar web programing";
        //$this->load->view('view-latihan1');
      
        echo "Selamat Datang .... Selamat belajar Web Programming";
        //$this->load->view('view-latihan1');

    }

    public function penjumlahan($n1, $n2)
    {
        $this->load->model('model_latihan1');

        $data['nilai1'] = $n1;
        $data['nilai2'] = $n2;
        $data['hasil'] = $this->model_latihan1->jumlah($n1, $n2);

        $this->load->view('view-latihan1' , $data);
        
        $this->load->model('Model_latihan1');
        $hasil = $this->Model_latihan1->jumlah($n1, $n2);
        echo "Hasil Penjumlahan dari". $n1 ." + ". $n2 ." = ".$hasil;
    }
}