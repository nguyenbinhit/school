<?php require_once __DIR__ . "/../Layout/header.php" ?>

<main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-sm mb-2 mb-sm-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-no-gutter">
                            <li class="breadcrumb-item"><a class="breadcrumb-link" href="<?php echo SITE_URL ?>index.php?controller=trainingStaff&action=index">Nhân viên quản lý</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Thêm mới</li>
                        </ol>
                    </nav>

                    <h1 class="page-header-title">Thêm mới nhân viên quản lý</h1>
                </div>
            </div>
        </div>

        <!-- Step Form -->
        <form class="js-step-form py-md-5">
            <div class="row justify-content-lg-center">
                <div class="col-lg-8">
                    <!-- Content Step Form -->
                    <div id="addUserStepFormContent">
                        <!-- Card -->
                        <div id="addUserStepProfile" class="card card-lg active">
                            <!-- Body -->
                            <div class="card-body">

                                <!-- Form Group -->
                                <div class="row form-group">
                                    <label for="firstNameLabel" class="col-sm-3 col-form-label input-label">Full name</label>

                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Pham Duc Thang">
                                    </div>
                                </div>
                                <!-- End Form Group -->

                                <!-- Form Group -->
                                <div class="row form-group">
                                    <label for="emailLabel" class="col-sm-3 col-form-label input-label">Email</label>

                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" name="email" id="emailLabel" placeholder="clarice@example.com">
                                    </div>
                                </div>
                                <!-- End Form Group -->

                                <!-- Form Group -->
                                <div class="row form-group">
                                    <label for="phoneLabel" class="col-sm-3 col-form-label input-label">Phone</label>

                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" name="phone" id="phone" placeholder="xxxx-xxx-xxx">
                                    </div>
                                </div>
                                <!-- End Form Group -->

                                <!-- Form Group -->
                                <div class="row form-group">
                                    <label for="passwordLabel" class="col-sm-3 col-form-label input-label">Password</label>

                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" name="password" id="password" placeholder="********">
                                    </div>
                                </div>
                                <!-- End Form Group -->

                                <!-- Form Group -->
                                <div class="row">
                                    <label class="col-sm-3 col-form-label input-label">Level</label>

                                    <div class="col-sm-9">
                                        <div class="input-group input-group-sm-down-break">
                                            <!-- Custom Radio -->
                                            <div class="form-control">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="levelRadio" id="levelRadio1">
                                                    <label class="custom-control-label" for="levelRadio1">ADMIM</label>
                                                </div>
                                            </div>
                                            <!-- End Custom Radio -->

                                            <!-- Custom Radio -->
                                            <div class="form-control">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="levelRadio" id="levelRadio2">
                                                    <label class="custom-control-label" for="levelRadio2">TRAINING STAFF</label>
                                                </div>
                                            </div>
                                            <!-- End Custom Radio -->
                                        </div>
                                    </div>
                                </div>
                                <!-- End Form Group -->
                            </div>
                            <!-- End Body -->

                            <!-- Footer -->
                            <div class="card-footer d-flex justify-content-end align-items-center">
                                <button type="button" class="btn btn-primary" type="submit">
                                    Create
                                </button>
                            </div>
                            <!-- End Footer -->
                        </div>
                        <!-- End Card -->
                    </div>
                    <!-- End Content Step Form -->
                </div>
            </div>
            <!-- End Row -->
        </form>
        <!-- End Step Form -->
    </div>
    <!-- End Content -->

    <?php require_once __DIR__ . "/../Layout/footer.php" ?>