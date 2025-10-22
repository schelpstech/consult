<?php
include("./inc/head.php");
?>

<body>

    <?php
    include("./inc/header.php");
    ?>

    <!-- **************** MAIN CONTENT START **************** -->
    <main>

        <!-- =======================
<?php
include("./inc/banner.php");
?>

        <!-- =======================
Page content START -->
        <section class="pt-0">
            <div class="container">
                <div class="row">

                    <?php
                    include("./inc/sidebar.php");
                    ?>

                    <!-- Main content START -->
                    <div class="col-xl-9">
                        <!-- Billing history START -->
                        <div class="card bg-transparent border rounded-3">
                            <!-- Card header START -->
                            <div class="card-header bg-transparent border-bottom">
                                <h3 class="mb-0">Transaction History</h3>
                            </div>
                            <!-- Card header END -->

                            <!-- Card body START -->
                            <div class="card-body">
                                <!-- Student list table START -->
                                <div class="table-responsive border-0">
                                    <table class="table table-dark-gray align-middle p-4 mb-0 table-hover">
                                        <!-- Table head -->
                                        <thead>
                                            <tr>
                                                <th scope="col" class="border-0 rounded-start">Date</th>
                                                <th scope="col" class="border-0">Reference</th>
                                                <th scope="col" class="border-0">Payment method</th>
                                                <th scope="col" class="border-0">Status</th>
                                                <th scope="col" class="border-0">Total</th>
                                                <th scope="col" class="border-0 rounded-end">Action</th>
                                            </tr>
                                        </thead>
                                        <!-- Table body -->
                                        <tbody>
                                            <!-- Table item -->
                                            <?php if (!empty($transactionHistory)): ?>
                                                <?php foreach ($transactionHistory as $transaction): ?>
                                                    <tr>
                                                        <!-- Date item -->
                                                        <td><?php echo date("d M Y", strtotime($transaction['created_at'])); ?></td>

                                                        <!-- Title item -->
                                                        <td>
                                                            <h6 class="mt-2 mt-lg-0 mb-0"><a href="#"><?= strtoupper($transaction['reference'] ?? "N/A"); ?></a></h6>
                                                        </td>

                                                        <!-- Payment method item -->
                                                        <td><img src="../assets/images/logo/paystack.png" class="h-40px" alt=""><span class="ms-2"><?= strtoupper($transaction['payment_method'] ?? "N/A"); ?></span></td>

                                                        <!-- Status item -->
                                                        <td>
                                                            <span class="badge bg-success bg-opacity-10 text-success"><?= strtoupper($transaction['status'] ?? "N/A"); ?></span>
                                                        </td>

                                                        <!-- total item -->
                                                        <td><?= number_format($transaction['amount'], 2) ?? "N/A"; ?></td>

                                                        <!-- Action item -->
                                                        <td>
                                                            <a href="#" class="btn btn-primary-soft btn-round me-1 mb-1 mb-md-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Download"><i class="bi bi-download"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="7" class="text-center">You have no orders yet.</td>
                                                </tr>
                                            <?php endif; ?>
                                            <!-- Table item -->

                                        </tbody>
                                    </table>
                                </div>
                                <!-- Student list table END -->
                            </div>
                            <!-- Card body START -->
                        </div>
                        <!-- Billing history END -->
                    </div>

                    <!-- Main content END -->

                </div> <!-- Row END -->
            </div>
        </section>
        <!-- =======================
Page content END -->

    </main>
    <!-- **************** MAIN CONTENT END **************** -->

    <?php
    include("./inc/footer.php");
    ?>