<div class="container my-5 pt-5">
    <div class="col-md-5 mx-auto">
        <div class="card">
            <div class="card-body text-center">
                <?php if ($status_code == 200) : ?>
                    <span class="display-3 text-success"> <i class="fa fa-check-circle"></i></span>
                    <h3>Pembayaran Berhasil </h3>
                    Dengan ID Order <b><?php echo $order_id; ?></b><br>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            Paket <span><?php echo $transaction_detail->tour_title; ?> </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            Harga <span><?php echo number_format($transaction_detail->gross_amount, 0, ",", "."); ?> </span>
                        </li>
                    </ul>
                    Terima Kasih Atas Pesanan Anda
                <?php else : ?>
                    Pembayaran Dengan ID Order <b><?php echo $order_id; ?></b><br>
                    Masih <?php echo $transaction_status; ?> silahkan selesaikan pembayaran anda
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>