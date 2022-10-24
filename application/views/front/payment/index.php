<?php $setting = $this->setting_model->detail();
$meta = $this->meta_model->get_meta() ?>
<section class="pt-2 pb-2 mt-0 align-items-center d-flex bg-primary" style="min-height: 150px;">
    <div class="container ">
        <div class="row">
            <div class="col-md-9 h-50 ">
            </div>
        </div>
    </div>
</section>
<section class="form-pencarian bg-none">
    <div class="container ">
        <div class="col-md-10 mx-auto">
            <div class="row">
                <div class="col-md-5">
                    <div class="card mb-5" style="margin-top:-60px;">
                        <div class="card-header bg-white">
                            <h4>
                                <?php if ($this->session->userdata('language') == 'EN') : ?>
                                    Customer Detail
                                <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                    Info Pelanggan
                                <?php else : ?>
                                    Info Pelanggan
                                <?php endif; ?>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <p class="col-3">
                                    <?php if ($this->session->userdata('language') == 'EN') : ?>
                                        Fullname
                                    <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                        Nama Lengkap
                                    <?php else : ?>
                                        Nama Lengkap
                                    <?php endif; ?>
                                </p>
                                <p class="col-9 text-muted text-end"><b><?php echo $transaction->fullname; ?></b></p>

                                <p class="col-3">
                                    <?php if ($this->session->userdata('language') == 'EN') : ?>
                                        Phone
                                    <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                        Nomor Hp
                                    <?php else : ?>
                                        Nomor Hp
                                    <?php endif; ?>
                                </p>
                                <p class="col-9 text-muted text-end"> <span class="text-muted"></span> <b><?php echo $transaction->phone; ?></b></span>
                                </p>
                                <p class="col-3">
                                    Email
                                </p>
                                <p class="col-9 text-muted text-end"><b><?php echo $transaction->email; ?></b></p>

                                <p class="col-3">
                                    <?php if ($this->session->userdata('language') == 'EN') : ?>
                                        Address
                                    <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                        Alamat
                                    <?php else : ?>
                                        Alamat
                                    <?php endif; ?>
                                </p>
                                <p class="col-9 text-muted text-end"><b><?php echo $transaction->address; ?> </b>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7" style="margin-top:-60px;">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-start bg-white">
                            <h4>
                                <?php if ($this->session->userdata('language') == 'EN') : ?>
                                    Complete Payment
                                <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                    Selesaikan Pembayaran
                                <?php else : ?>
                                    Selesaikan Pembayaran
                                <?php endif; ?>
                            </h4>
                            <h4><?php echo $transaction->invoice_number; ?></h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Item</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th><?php echo $transaction->tour_title; ?></th>
                                        <td><?php echo $transaction->quantity; ?></td>
                                        <td><?php echo number_format($transaction->price, 0, ",", "."); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="text-end">
                                    Total Amount
                                    <p class="ms-auto display-5 fw-bold">Rp. <?php echo number_format($transaction->total_price, 0, ",", "."); ?></p>
                                </div>
                            </div>
                            <?php if ($setting->payment_gateway == 0) : ?>
                                Silahkan Transfer Ke Nomor Rekening di bawah ini
                                <div class="alert alert-success">
                                    <?php foreach ($bank as $bank) : ?>
                                        <?php echo $bank->bank_name; ?> No. Rek <?php echo $bank->bank_number; ?> Atas Nama <?php echo $bank->bank_account; ?>
                                        <hr>
                                    <?php endforeach; ?>
                                </div>
                                <a href="https://wa.me/<?php echo $meta->whatsapp; ?>" class="btn btn-success text-white" type="submit">
                                    <?php if ($this->session->userdata('language') == 'EN') : ?>
                                        <i class="fa-brands fa-whatsapp me-2"></i> Confirmation
                                    <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                        <i class="fa-brands fa-whatsapp me-2"></i> Konfirmasi
                                    <?php else : ?>
                                        <i class="fa-brands fa-whatsapp me-2"></i> Konfirmasi
                                    <?php endif; ?>
                                </a>
                            <?php else : ?>
                                <?php if ($transaction->payment_url == null) : ?>
                                    <form action="<?php echo site_url() ?>payment/vtweb_checkout" method="POST" id="payment-form">
                                        <input type="hidden" id="transaksi_id" name="transaksi_id" value="<?php echo $transaction->id; ?>">
                                        <input type="hidden" id="gross_amount" name="gross_amount" value="<?php echo $transaction->total_price; ?>">
                                        <input type="hidden" id="amount" name="amount" value="<?php echo $transaction->price; ?>">
                                        <input type="hidden" id="name" name="name" value="<?php echo $transaction->tour_title; ?>">
                                        <input type="hidden" id="first_name" name="first_name" value="<?php echo $transaction->fullname; ?>">
                                        <input type="hidden" id="email" name="email" value="<?php echo $transaction->email; ?>">
                                        <input type="hidden" id="phone" name="phone" value="<?php echo $transaction->phone; ?>">
                                        <input type="hidden" id="quantity" name="quantity" value="<?php echo $transaction->quantity; ?>">
                                        <?php if ($transaction->status_code == 200) : ?>
                                            <div class="alert alert-success">Transakasi Sudah Di bayar</div>
                                        <?php else : ?>
                                            <button class="btn btn-success" type="submit">Bayar</button>
                                        <?php endif; ?>
                                    </form>
                                <?php else : ?>
                                    <div class="d-grid gap-2">
                                        <a href="<?php echo $transaction->payment_url; ?>" class="btn btn-success" type="submit">
                                            <?php if ($this->session->userdata('language') == 'EN') : ?>
                                                <i class="fa-solid fa-money-check-dollar me-2"></i> Pay
                                            <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                                <i class="fa-solid fa-money-check-dollar me-2"></i> Bayar
                                            <?php else : ?>
                                                <i class="fa-solid fa-money-check-dollar me-2"></i> Bayar
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>