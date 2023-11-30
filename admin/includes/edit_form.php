


<body>



    <main id="main" class="main">
       

        <section class="section">
            <div class="container">
                
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <!-- Your form goes here -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Edit User Form</h5>
                                <form class="row g-3" action="update_user.php" method="post">

                                    <div class="col-12">
                                        <label for="inputName" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="inputName" name="username">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputEmail" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="inputEmail" name="email">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputPassword" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="inputPassword" name="password">
                                    </div>
                                    <input type="hidden" name="id" id="inputId">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                    </div>
                                </form><!-- End Form -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->

</body>

</html>
