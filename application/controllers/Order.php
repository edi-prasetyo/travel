<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{
  /**
   * Development By Edi Prasetyo
   * edikomputer@gmail.com
   * 0812 3333 5523
   * https://edikomputer.com
   * https://grahastudio.com
   * 
   * index
   * trip
   * create
   * success
   * 
   */
  public function __construct()
  {
    parent::__construct();
    $this->output->enable_profiler(FALSE);
    $this->load->model('tour_model');
    $this->load->model('schedule_model');
    $this->load->model('meta_model');
    $this->load->model('transaction_model');
    $this->load->model('setting_model');
    $this->load->model('email_model');
    $this->load->library('pagination');
  }
  // index
  public function index()
  {
    redirect(base_url(), 'refresh');
  }
  // trip
  public function trip($id)
  {
    $meta       = $this->meta_model->get_meta();
    $tour       = $this->schedule_model->detail_order($id);
    $data = array(
      'title'                       => 'Tour',
      'deskripsi'                   => 'Trip - ' . $meta->description,
      'keywords'                    => 'Trip - ' . $meta->keywords,
      'paginasi'                    => $this->pagination->create_links(),
      'tour'                        => $tour,
      'content'                     => 'front/order/trip'
    );
    $this->load->view('front/layout/wrapp', $data, FALSE);
  }
  // create
  public function create()
  {
    $setting = $this->setting_model->detail();
    $this->form_validation->set_rules(
      'fullname',
      'Nama',
      'required',
      array(
        'required'                        => '%s Harus Diisi',
      )
    );
    if ($this->form_validation->run() === FALSE) {
      $data = [
        'title'                           => 'Order',
        'content'                         => 'front/order/trip'
      ];
      $this->load->view('front/layout/wrapp', $data, FALSE);
    } else {
      $invoice_number = strtoupper(random_string('numeric', 7));

      $price = $this->input->post('price');
      $quantity = $this->input->post('quantity');
      $total_price = (int)$price * (int)$quantity;

      $data  = [
        'fullname'              => $this->input->post('fullname'),
        'email'                 => $this->input->post('email'),
        'phone'                 => $this->input->post('phone'),
        'address'               => $this->input->post('address'),
        'tour_id'               => $this->input->post('tour_id'),
        'schedule_id'               => $this->input->post('schedule_id'),
        'tour_title'            => $this->input->post('tour_title'),
        'tour_date'             => $this->input->post('tour_date'),
        'address'               => $this->input->post('address'),
        'payment'               => $this->input->post('payment'),
        'quantity'              => $quantity,
        'price'                 => $price,
        'total_price'           => $total_price,
        'invoice_number'        => $invoice_number,
        'payment_status'        => 'pending',
        'created_at'            => date('Y-m-d')
      ];
      $insert_id = $this->transaction_model->create($data);
      if ($setting->email_order == 1) {
        $this->_sendEmail($insert_id);
        $this->session->set_flashdata('sukses', 'Checkout Berhasil');
        redirect(base_url('payment?id=' . md5($insert_id)), 'refresh');
      } else {
        $this->session->set_flashdata('sukses', 'Checkout Berhasil');
        redirect(base_url('payment?id=' . md5($insert_id)), 'refresh');
      }
    }
  }

  private function _sendEmail($insert_id)
  {
    $email_order = $this->email_model->email_order();
    $transaction  = $this->transaction_model->last_detail($insert_id);
    $meta = $this->meta_model->get_meta();

    $config = [
      'protocol'     => "$email_order->protocol",
      'smtp_host'   => "$email_order->smtp_host",
      'smtp_port'   => $email_order->smtp_port,
      'smtp_user'   => "$email_order->smtp_user",
      'smtp_pass'   => "$email_order->smtp_pass",
      'mailtype'     => 'html',
      'charset'     => 'utf-8',
    ];

    $this->load->library('email', $config);
    $this->email->initialize($config);
    $this->email->set_newline("\r\n");
    $this->email->from("$email_order->smtp_user", 'Order');
    $this->email->to($this->input->post('email'));

    $this->email->subject('Order ' . $transaction->order_id . '');
    $this->email->message('
                         
                           
                      
                          <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=320, initial-scale=1" />
  <title>Airmail Invoice</title>
  <style type="text/css">

 
    #outlook a {
      padding: 0;
    }


    .ReadMsgBody {
      width: 100%;
    }

    .ExternalClass {
      width: 100%;
    }


    .ExternalClass,
    .ExternalClass p,
    .ExternalClass span,
    .ExternalClass font,
    .ExternalClass td,
    .ExternalClass div {
      line-height: 100%;
    }



    body, table, td, p, a, li, blockquote {
      -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
    }


    table, td {
      mso-table-lspace: 0pt;
      mso-table-rspace: 0pt;
    }


    img {
      -ms-interpolation-mode: bicubic;
    }



    html,
    body,
    .body-wrap,
    .body-wrap-cell {
      margin: 0;
      padding: 0;
      background: #ffffff;
      font-family: Arial, Helvetica, sans-serif;
      font-size: 14px;
      color: #464646;
      text-align: left;
    }

    img {
      border: 0;
      line-height: 100%;
      outline: none;
      text-decoration: none;
    }

    table {
      border-collapse: collapse !important;
    }

    td, th {
      text-align: left;
      font-family: Arial, Helvetica, sans-serif;
      font-size: 14px;
      color: #464646;
      line-height:1.5em;
    }

    b a,
    .footer a {
      text-decoration: none;
      color: #464646;
    }

    a.blue-link {
      color: blue;
      text-decoration: underline;
    }

 

    td.center {
      text-align: center;
    }

    .left {
      text-align: left;
    }

    .body-padding {
      padding: 24px 40px 40px;
    }

    .border-bottom {
      border-bottom: 1px solid #D8D8D8;
    }

    table.full-width-gmail-android {
      width: 100% !important;
    }


    .header {
      font-weight: bold;
      font-size: 16px;
      line-height: 16px;
      height: 16px;
      padding-top: 19px;
      padding-bottom: 7px;
    }

    .header a {
      color: #464646;
      text-decoration: none;
    }


    .footer a {
      font-size: 12px;
    }
  </style>

  <style type="text/css" media="only screen and (max-width: 650px)">
    @media only screen and (max-width: 650px) {
      * {
        font-size: 16px !important;
      }

      table[class*="w320"] {
        width: 320px !important;
      }

      td[class="mobile-center"],
      div[class="mobile-center"] {
        text-align: center !important;
      }

      td[class*="body-padding"] {
        padding: 20px !important;
      }

      td[class="mobile"] {
        text-align: right;
        vertical-align: top;
      }
    }
  </style>

</head>
<body style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
 <td valign="top" align="left" width="100%" style="background: #ffffff;">
 <center>
   <table class="w320 full-width-gmail-android" bgcolor="#ffffff" cellpadding="0" cellspacing="0" border="0" width="100%">
      <tr>
        <td width="100%" height="48" valign="top">           
              <table class="full-width-gmail-android" cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                  <td class="header center" width="100%" >
                    <a href="' . $meta->link . '" style="color:#ffffff;">
                    <img class="left" width="20%" height="auto" src="' . base_url('assets/img/logo/' . $meta->logo) . '" alt="' . $meta->title . '">
                    </a>
                  </td>
                </tr>
              </table>
        </td>
      </tr>
    </table>

    <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ffffff">
      <tr>
        <td align="center">
          <center>
            <table class="w320" cellspacing="0" cellpadding="0" width="600">
              <tr>
                <td class="body-padding mobile-padding">

                <table cellspacing="0" cellpadding="0" width="100%">
                  <tr>
                    <td class="left" style="padding-bottom:20px; text-align:left;">
                      <b>Invoice:</b> ' . $transaction->invoice_number . '
                    </td>
                  </tr>
                  <tr>
                    <td class="left" style="padding-bottom:40px; text-align:left;">
                    <span style="font-size:20px;"> Hi <b>' . $transaction->fullname .  '</b>,</span>
                    <br>
                    Terima kasih Telah menggunakan layanan ' . $meta->link . ' . Order Anda Telah Kami Terima, Kami Akan Segera Menghubungi Anda
                    </td>
                  </tr>
                </table>

                <br>

                <div style="border:1px solid #ddd;border-radius:4px">
                <div style="background:#0279d6;color:#ffff;padding:5px 0 5px 20px;border-radius:4px 4px 0 0">
                <b>Informasi Order</b>
                </div>
                <div style="padding:10px;">
                <table cellspacing="0" cellpadding="0" width="100%">
                
                
                  <tr>
                  <td>Layanan </td> 
                  <td>: ' . $transaction->tour_title . ' <br> ' . $transaction->tour_date . ' </td>
                  </tr>
                

                

                  <tr>
                  <td>Quantity </td> 
                  <td>: ' . $transaction->quantity . ' Pack</td>
                  </tr>

                  <tr>
                  <td>Total Harga </td> 
                  <td style="font-size:18px;color:#0070ee;">: <b>Rp. ' . number_format($transaction->total_price, 0, ",", ".") . '</b></td>
                  </tr>

                  <tr>
                  <td>Link Pembayaran </td> 
                  <td style="font-size:18px;color:#0070ee;">: ' . base_url('payment?id=' . md5($insert_id)) . '</td>
                  </tr>
                         
                  </table>
                  
                  </div>
                  </div>
                  <br>
            

                <div style="border:1px solid #ddd;border-radius:4px">
                <div style="background:#0279d6;color:#ffff;padding:5px 0 5px 20px;border-radius:4px 4px 0 0">
                <b>Informasi Pelanggan</b>
                </div>
                <div style="padding:10px;">
                <table cellspacing="0" cellpadding="0" width="100%">
                
                
                
                  <tr>
                  <td>Nama </td> 
                  <td>: ' . $transaction->fullname . '</td>
                  </tr>

                  <tr>
                  <td>Nomor Hp. </td> 
                  <td>: ' . $transaction->phone . '</td>
                  </tr>

                  <tr>
                  <td>email </td> 
                  <td>: ' . $transaction->email . '</td>
                  </tr>

                  <tr>
                  <td>Tanggal Trip </td> 
                  <td>: ' . date("j M Y", strtotime($transaction->tour_date)) . '</td>
                  </tr>
                          
                  </table>
                  
                  </div>
                  </div>
                  <br>


                <table cellspacing="0" cellpadding="0" width="100%">
                  <tr>
                    <td class="left" style="text-align:left;">
                      Terima Kasih,
                    </td>
                  </tr>
                  <tr>
                    <td class="left" width="auto" height="20" style="padding-top:10px; text-align:left;">
                      
                    </td>
                  </tr>
                </table>

                </td>
              </tr>
            </table>

          </center>
        </td>
      </tr>
    </table>

    


    <table class="w320" bgcolor="#2f383f" cellpadding="0" cellspacing="0" border="0" width="100%">
      <tr>
        <td align="center">
          <center>
            <table class="w320" cellspacing="0" cellpadding="0" width="500" bgcolor="#2f383f">
              <tr>
                <td>
                  <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#2f383f">
                    <tr>
                      <td class="center" style="padding:25px; text-align:center;color:#ffffff">
                       Silahkan Hubungi  <b> ' . $meta->telepon . '</b> Untuk informasi lebih lanjut
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
      <tr>
        
      </tr>
    </table>
    

  </center>
  </td>
</tr>
</table>
</body>
</html>
        ');

    if ($this->email->send()) {
      return true;
    }
  }
  // success
  public function success($insert_id)
  {
  }
}
