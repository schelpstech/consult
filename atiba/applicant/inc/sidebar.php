<!-- Left sidebar START -->
<div class="col-xl-3">
    <!-- Responsive offcanvas body START -->
    <div class="offcanvas-xl offcanvas-end" tabindex="-1" id="offcanvasSidebar">
        <!-- Offcanvas header -->
        <div class="offcanvas-header bg-light">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">My profile</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasSidebar" aria-label="Close"></button>
        </div>
        <!-- Offcanvas body -->
        <div class="offcanvas-body p-3 p-xl-0">
            <div class="bg-success border rounded-3 p-3 w-100">
                <!-- Dashboard menu -->
                <div class="list-group list-group-dark list-group-borderless collapse-list">
                    <!-- Always available -->
                    <a class="list-group-item" href="dashboard.php">
                        <i class="bi bi-speedometer2 fa-fw me-2"></i>Dashboard
                    </a>
                    <hr>
                    <!-- Forms locked until payment -->
                    <a class="list-group-item <?php echo !$paymentMade ? 'disabled text-muted' : ''; ?>"
                        href="<?php echo $paymentMade ? 'biodataform.php' : '#'; ?>">
                        <i class="bi bi-person-badge fa-fw me-2"></i>Bio-Data
                    </a>
                    <hr>
                    <a class="list-group-item <?php echo !$paymentMade ? 'disabled text-muted' : ''; ?>"
                        href="<?php echo $paymentMade ? 'contactform.php' : '#'; ?>">
                        <i class="bi bi-telephone fa-fw me-2"></i>Contact Details
                    </a>
                    <hr>
                    <a class="list-group-item <?php echo !$paymentMade ? 'disabled text-muted' : ''; ?>"
                        href="<?php echo $paymentMade ? 'educationhistform.php' : '#'; ?>">
                        <i class="bi bi-mortarboard fa-fw me-2"></i>Education History
                    </a>
                    <hr>
                    <a class="list-group-item <?php echo !$paymentMade ? 'disabled text-muted' : ''; ?>"
                        href="<?php echo $paymentMade ? 'programmedetails.php' : '#'; ?>">
                        <i class="bi bi-journal-text fa-fw me-2"></i>Programme Details
                    </a>
                    <hr>
                    <a class="list-group-item <?php echo !$paymentMade ? 'disabled text-muted' : ''; ?>"
                        href="<?php echo $paymentMade ? 'documentform.php' : '#'; ?>">
                        <i class="bi bi-upload fa-fw me-2"></i>Document Upload
                    </a>
                    <hr>
                    <?php
                    $canPreview = $paymentMade && !empty($progress['supporting_docs']); // adjust variable name as needed
                    $disabled = !$canPreview;
                    ?>
                    <a class="list-group-item <?php echo $disabled ? 'disabled text-muted' : ''; ?>"
                        href="<?php echo $disabled ? '#' : 'previewform.php'; ?>"
                        <?php echo $disabled ? 'tabindex="-1" aria-disabled="true" onclick="return false;"' : ''; ?>>
                        <i class="bi bi-eye me-2" aria-hidden="true"></i> Application Preview
                    </a>

                    <hr>

                    <!-- Always available -->
                    <a class="list-group-item" href="transaction.php">
                        <i class="bi bi-credit-card fa-fw me-2"></i>Transaction History
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Responsive offcanvas body END -->
</div>
<!-- Left sidebar END -->